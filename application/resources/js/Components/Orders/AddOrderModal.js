import React, {useState} from "react";
import {useDispatch} from "react-redux";
import {Button, Grid, Dialog, DialogTitle, DialogContent, TextField, DialogActions} from "@material-ui/core";
import {useForm, Controller} from "react-hook-form";
import {isPositiveInteger, isPositiveFloat} from "../../CustomValidationRules/customValidationRules";
import {storeOrder} from "../../Actions/orderActions";
import {getOrders} from "../../Redux/ducks/orders";

const AddOrderModal = () => {
    const [open, setOpen] = useState(false);
    const {control, handleSubmit, formState: { errors }, reset} = useForm();
    const dispatch = useDispatch();

    const handleClose = () => {
        setOpen(false);
        reset({
            series: '',
            name: '',
            number: '',
            amount: '',
            order_price: '',
            list_price: '',
            estimated_price: '',
            shop: '',
            order_date: '',
            delivery_date: ''
        });
    };
    const handleClickOpen = () => setOpen(true);

    const onSubmit = async data => {
        await storeOrder(data);
        dispatch(getOrders());
        handleClose();
    };

    return (
        <Grid item>
            <Button
                color="primary"
                fullWidth
                variant="contained"
                onClick={handleClickOpen}
            >
                Dodaj zamówienie
            </Button>

            <Dialog open={open} onClose={handleClose} aria-labelledby="form-dialog-title">
                <DialogTitle id="form-dialog-title">Dodaj zamówienie</DialogTitle>
                <DialogContent>
                    <form onSubmit={handleSubmit(onSubmit)} id="new-order-form">
                        <Controller
                            name="series"
                            control={control}
                            defaultValue=""
                            rules={{required: true}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.series}
                                helperText={!!errors.series && 'Uzupełnij to pole'}
                                autoFocus
                                margin="dense"
                                id="series"
                                label="Seria"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="name"
                            control={control}
                            defaultValue=""
                            rules={{required: true}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.name}
                                helperText={!!errors.name && 'Uzupełnij to pole'}
                                margin="dense"
                                id="name"
                                label="Nazwa"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="number"
                            control={control}
                            defaultValue=""
                            rules={{required: true}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.number}
                                helperText={!!errors.number && 'Uzupełnij to pole'}
                                margin="dense"
                                id="number"
                                label="Numer"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="amount"
                            control={control}
                            defaultValue=""
                            rules={{required: true, validate: isPositiveInteger}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.amount}
                                helperText={!!errors.amount && 'Uzupełnij to pole liczbą całkowitą większą od 0'}
                                margin="dense"
                                id="amount"
                                label="Ilość"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="order_price"
                            control={control}
                            defaultValue=""
                            rules={{required: true, validate: isPositiveFloat}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.order_price}
                                helperText={!!errors.order_price && 'Uzupełnij to pole liczbą większą od 0'}
                                margin="dense"
                                id="order_price"
                                label="Cena zamówienia (szt.)"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="list_price"
                            control={control}
                            defaultValue=""
                            rules={{required: true, validate: isPositiveFloat}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.list_price}
                                helperText={!!errors.list_price && 'Uzupełnij to pole liczbą większą od 0'}
                                margin="dense"
                                id="list_price"
                                label="Cena katalogowa (szt.)"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="estimated_price"
                            control={control}
                            defaultValue=""
                            rules={{required: true, validate: isPositiveFloat}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.estimated_price}
                                helperText={!!errors.estimated_price && 'Uzupełnij to pole liczbą większą od 0'}
                                margin="dense"
                                id="estimated_price"
                                label="Planowana cena sprzedaży (szt.)"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="shop"
                            control={control}
                            defaultValue=""
                            rules={{required: true}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.shop}
                                helperText={!!errors.shop && 'Uzupełnij to pole'}
                                margin="dense"
                                id="shop"
                                label="Sklep"
                                type="text"
                                fullWidth
                            />}
                        />
                        <Controller
                            name="order_date"
                            control={control}
                            defaultValue=""
                            rules={{required: true}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.order_date}
                                helperText={!!errors.order_date && 'Uzupełnij to pole'}
                                margin="dense"
                                id="order_date"
                                label="Data zamówienia"
                                type="date"
                                InputLabelProps={{
                                    shrink: true,
                                }}
                                fullWidth
                            />}
                        />
                        <Controller
                            name="delivery_date"
                            control={control}
                            defaultValue=""
                            rules={{required: true}}
                            render={({ field }) => <TextField
                                {...field}
                                error={!!errors.delivery_date}
                                helperText={!!errors.delivery_date && 'Uzupełnij to pole'}
                                margin="dense"
                                id="delivery_date"
                                label="Przewidywana data dostarczenia"
                                type="date"
                                InputLabelProps={{
                                    shrink: true,
                                }}
                                fullWidth
                            />}
                        />
                    </form>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose} color="primary">
                        Anuluj
                    </Button>
                    <Button
                        color="primary"
                        type="submit"
                        form="new-order-form"
                        variant="contained"
                    >
                        Zapisz
                    </Button>
                </DialogActions>
            </Dialog>
        </Grid>
    );
};

export default AddOrderModal;
