import React, {useEffect, useState} from "react";
import {Dialog, Grid, DialogTitle, DialogContent} from "@material-ui/core";

const AddSaleModal = ({order}) => {
    const [open, setOpen] = useState(order !== null);

    useEffect(() => {
        setOpen(order !== null);
    }, [order]);

    const handleClose = () => {
        setOpen(false);
    };

    const handleSubmit = () => {

    };

    return (
        <Grid item>
            <Dialog open={open} onClose={handleClose} aria-labelledby="form-dialog-title">
                <DialogTitle>
                    Dodaj sprzedaż
                </DialogTitle>
                <DialogContent>
                    <form onSubmit={()=> handleSubmit(onSubmit)} id="new-order-form">
                    </form>
                </DialogContent>
            </Dialog>
        </Grid>
    );
};

export default AddSaleModal;
