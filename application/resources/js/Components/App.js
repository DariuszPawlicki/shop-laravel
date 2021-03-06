import React, {useState} from "react";
import {Grid, AppBar, Tabs, Tab, Box, Typography} from "@material-ui/core";
import { makeStyles } from '@material-ui/core/styles';
import PropTypes from 'prop-types';
import Orders from "./Orders/Orders";

function TabPanel(props) {
    const {children, value, index, ...other} = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box p={3}>
                    {children}
                </Box>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired,
};

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        'aria-controls': `simple-tabpanel-${index}`,
    };
}

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
        backgroundColor: "#333333",
    },
}));

const App = () => {
    const [value, setValue] = useState(0);
    const handleChange = (event, newValue) => {
        setValue(newValue);
    };
    const classes = useStyles();

    return (
        <div className={classes.root}>
            <Grid container direction="column">
                <Grid item>
                    <AppBar position="static">
                        <Tabs value={value} onChange={handleChange} aria-label="simple tabs example">
                            <Tab label="Zamówienia" {...a11yProps(0)} />
                            <Tab label="Sprzedane" disabled {...a11yProps(1)} />
                        </Tabs>
                    </AppBar>
                    <TabPanel value={value} index={0}>
                        <Orders/>
                    </TabPanel>
                    <TabPanel value={value} index={1}>
                        Item Two
                    </TabPanel>
                </Grid>
            </Grid>
        </div>
    );
};

export default App;
