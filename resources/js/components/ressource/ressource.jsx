import React, { useState, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import Typography from "@material-ui/core/Typography";
// import ReactHtmlParser, { processNodes, convertNodeToElement, htmlparser2 } from 'react-html-parser';
import ReactHtmlParser from 'react-html-parser';
import Button from '@material-ui/core/Button';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';


const useStyles = makeStyles({
    root: {
        minWidth: "80%",


    },
    title: {
        fontSize: 14,
    },
    pos: {
        marginBottom: 12,
    },
    content: {
        boxShadow: "rgba(99, 99, 99, 0.2) 0px 2px 8px 0px",
        marginBottom: 50,
        backgroundColor: "#fdfdfd",
    },
    backButton: {
        marginBottom: 50,
        width: "100%",
    },
});

export default function Ressource(props) {
    const classes = useStyles();
    const [ressources, setRessources] = useState([]);

    useEffect(() => {
        setRessources(Object.entries(props.ressources));
    }, []);


    return (
        <div>
            <h1>Ressources</h1>
            <Button onClick={() => props.handleView('formation')} variant="outlined" className={classes.backButton}>
                Revenir sur la page de formation</Button>
            <div className={classes.root}>
                {ressources.map((ressource, index) => (
                    <Card key={index} className={classes.root} className={classes.content}>
                        <CardContent>
                            <Typography className={classes.title} color="textSecondary" gutterBottom>
                                {ReactHtmlParser(ressource[1].text)}
                            </Typography>

                        </CardContent>
                    </Card>
                ))}
            </div>
        </div>
    );
}







