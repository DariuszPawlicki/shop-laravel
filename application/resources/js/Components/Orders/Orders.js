import React, {useEffect, useState} from "react";
import {Grid, Chip, Avatar, makeStyles, Tooltip} from "@material-ui/core";
import AddOrderModal from "./AddOrderModal";
import EditOrderModal from "./EditOrderModal";
import {useDispatch, useSelector} from "react-redux";
import {getOrders} from "../../Redux/ducks/orders";
import { DataGrid } from '@material-ui/data-grid';
import EditIcon from '@material-ui/icons/Edit';
import DeleteIcon from '@material-ui/icons/Delete';
import AddShoppingCartIcon from '@material-ui/icons/AddShoppingCart';
import {deleteOrder} from "../../Actions/orderActions";
import AddSaleModal from "./AddSaleModal";

const tableStyles = makeStyles({
    table: {
        '& .white-text': {
            color: '#ffffff'
        }
    }
});

const Orders = () => {
    const classes = tableStyles();
    const [editedOrder, setEditedOrder] = useState(null);
    const [orderForSale, setOrderForSale] = useState(null);

    const dispatch = useDispatch();
    useEffect(() => {
        dispatch(getOrders());
    }, [dispatch]);

    let ordinalNumber = 1;
    const orders = useSelector(state => state.order.orders).map(order => ({...order, ordinal_number: ordinalNumber++}));
    const allOrdersPrice = orders.reduce((carry, current) => carry + (current.order_price * current.amount), 0);
    const allOrdersPriceFormatted = new Number(allOrdersPrice).toFixed(2);

    const columns = [
        {field: 'ordinal_number', headerName: 'Lp', width: 100, type: 'number', headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'name', headerName: 'Nazwa', width: 200, headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'series', headerName: 'Seria', width: 200, headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'number', headerName: 'Numer', headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'shop', headerName: 'Sklep', width: 200, headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'order_price', headerName: 'Cena za szt.', width: 140, type: 'number', headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'estimated_price', headerName: 'Planowana cena za szt.', width: 140, type: 'number', headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'amount', headerName: 'Ilość', type: 'number', headerClassName: 'white-text', cellClassName: 'white-text'},
        {
            field: 'price',
            headerName: 'Cena zamówienia',
            width: 140,
            type:'number',
            headerClassName: 'white-text',
            cellClassName: 'white-text',
            valueGetter: params => {
                const price = +params.getValue('order_price') * params.getValue('amount');
                return new Number(price).toFixed(2);
            }
        },
        {field: 'list_price', headerName: 'Cena katalogowa za szt.', width: 140, type: 'number', headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'order_date', headerName: 'Data zamówienia', type: 'date', width: 150, headerClassName: 'white-text', cellClassName: 'white-text'},
        {field: 'delivery_date', headerName: 'Data dostarczenia', type: 'date', width: 150, headerClassName: 'white-text', cellClassName: 'white-text'},
        {
            field: 'actions',
            headerName: ' ',
            width: 150,
            headerClassName: 'white-text',
            cellClassName: 'white-text',
            renderCell: (params) => {
                const deleteCurrentOrder = orderId => {
                    deleteOrder(orderId).then(() => dispatch(getOrders()));
                }
                return (
                    <div>
                    <Tooltip title="Edytuj">
                        <EditIcon cursor="pointer" onClick={() => setEditedOrder(params.row)}/>
                    </Tooltip>
                    <Tooltip title="Usuń">
                        <DeleteIcon cursor="pointer" onClick={() => deleteCurrentOrder(params.row.id)}/>
                    </Tooltip>
                    </div>
                );
            },
            disableColumnMenu: true
        },
    ];


    return (
        <Grid container direction="column" spacing={2}>
            <AddOrderModal/>
            <EditOrderModal order={editedOrder}/>
            <AddSaleModal order={orderForSale}/>
            <Grid item>
                <Chip avatar={<Avatar >$</Avatar>} label={`Koszt w sumie: ${allOrdersPriceFormatted} zł`}/>
            </Grid>
            <Grid item>
                <DataGrid
                    autoHeight
                    columns={columns}
                    rows={orders}
                    className={classes.table}
                    hideFooter={true}
                    autoPageSize={true}
                />
            </Grid>
        </Grid>
    );
};

export default Orders;
