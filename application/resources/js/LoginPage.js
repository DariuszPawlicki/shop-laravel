import { useState } from "react";
import { TextField, Paper, Button, FormControl } from "@material-ui/core";
import { useStyles } from "./style";

const LoginPage = () => {
    const classes = useStyles();
    const [formData, setData] = useState({});

    const setFormData = e => {
        setData({
            ...formData,
            [e.target.id]: e.target.value
        });
    };

    const sendData = () => {
        //tutaj działasz z formData
    };
    console.log("formData", formData);
    return (
        <Paper color="#1d1d1d" elevation={3} className={classes.wrapperForm}>
            <FormControl
                action="POST"
                style={{
                    display: "flex",
                    height: "600px",
                    width: "100%",
                    maxWidth: "600px",
                    justifyContent: "center",
                    alignItems: "center",
                    flexDirection: "column",
                    backgroundColor: "#fffdd0",
                    opacity: "0.9",
                    border: "2px solid #fffdd0",
                    borderRadius: "20px"
                }}
            >
                <h1>Log In</h1>
                <TextField
                    style={{ width: "80%", margin: "10px" }}
                    onChange={e => setFormData(e)}
                    id="login"
                    label="login"
                    variant="outlined"
                />
                <TextField
                    style={{
                        width: "80%",
                        margin: "10px 0"
                    }}
                    onChange={e => setFormData(e)}
                    id="password"
                    label="password"
                    variant="outlined"
                />
                <Button
                    type="submit"
                    onClick={sendData}
                    style={{ width: "60%" }}
                    variant="outlined"
                    color="primary"
                >
                    Log In
                </Button>
            </FormControl>
        </Paper>
    );
};

export default LoginPage;
