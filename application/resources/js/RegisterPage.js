import { useState } from "react";
import { TextField, Container, Button, FormControl } from "@material-ui/core";
import { useStyles } from "./style";
import { useNavigate } from "react-router-dom";

const RegisterPage = () => {
    const classes = useStyles();
    const [formData, setData] = useState({});

    const navigate = useNavigate();

    const setFormData = e => {
        setData({
            ...formData,
            [e.target.id]: e.target.value
        });
    };

    const sendData = () => {
        if (formData == {}) return;
        axios
            .post("/register", formData)
            .then(() => navigate("/login"))
            .catch(error => alert(error));
    };

    console.log("formData", formData);
    return (
        <Container
            maxWidth="xl"
            color="#1d1d1d"
            className={classes.wrapperForm}
        >
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
                    backgroundColor: "#c4c3a1",
                    opacity: "0.9",
                    border: "2px solid #c4c3a1",
                    borderRadius: "20px"
                }}
            >
                <h1>Register</h1>
                <TextField
                    style={{ width: "80%", margin: "10px" }}
                    onChange={e => setFormData(e)}
                    id="name"
                    label="name"
                    variant="outlined"
                />
                <TextField
                    style={{ width: "80%", margin: "10px" }}
                    onChange={e => setFormData(e)}
                    id="email"
                    label="email"
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
                <TextField
                    style={{
                        width: "80%",
                        margin: "10px 0"
                    }}
                    onChange={e => setFormData(e)}
                    id="password_confirmation"
                    label="confirm password"
                    variant="outlined"
                />
                <Button
                    type="submit"
                    onClick={sendData}
                    style={{ width: "60%" }}
                    variant="outlined"
                    color="primary"
                >
                    Register
                
                </Button>
                <Button
                    onClick={() => {
                        navigate('/login');
                    }}
                    style={{ width: "60%", marginTop: "5px"}}
                    variant="outlined"
                    color="primary"
                >
                    Back
                
                </Button>
            </FormControl>
        </Container>
    );
};

export default RegisterPage;
