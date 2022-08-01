import React, { useState, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import Accordion from "@material-ui/core/Accordion";
import AccordionDetails from "@material-ui/core/AccordionDetails";
import AccordionSummary from "@material-ui/core/AccordionSummary";
import Typography from "@material-ui/core/Typography";
import ArrowDropDownIcon from '@material-ui/icons/ArrowDropDown';
import axios from "axios";
import CustomizedInputBase from '../searchInput/searchInput';
import ReactHtmlParser, { processNodes, convertNodeToElement, htmlparser2 } from 'react-html-parser';
import Button from '@material-ui/core/Button';
import QuestionAnswerOutlinedIcon from '@material-ui/icons/QuestionAnswerOutlined';


const useStyles = makeStyles((theme) => ({
    root: {
        width: "100%",
        minWidth: "100%",
        display: "flex",
        flexDirection: "column",
        alignItems: "center",
        marginTop: "30px",
        // border: "solid 1px red",
    },
    heading: {
        height: "60px",
        paddingTop: "20px",
    },
    accordeon: {
        borderRadius: "5px",
        marginBottom: "10px",
        width: "100%",
        // boxShadow: "-4px 9px 25px -6px rgba(0, 0, 0, 0.1)",
        // boxShadow: "rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px",
        // boxShadow: "rgba(99, 99, 99, 0.2) 0px 2px 8px 0px",
        boxShadow: "none",
        // border: "solid 1px blue",
    },
}));

export default function Faq(props) {
    const classes = useStyles();
    const [faqs, setFaqs] = useState([]);

    useEffect(() => {
        setFaqs(Object.entries(props.faqs));
    }, []);

    const handleChange = (e) => {
        const value = e.currentTarget.value;
        axios.get(`${globalUrl}faqChange`,
            {
                params: {
                    value: value,
                    formation_id: idFormation,
                }
            }).then((res) => {
                const faqData = Object.entries(res.data);
                setFaqs(faqData);
            });
    }

    return (
        <div className={classes.root}>

            <Button onClick={() => props.handleView('formation')} variant="outlined" className="quizBackButton">
                Revenir sur la page de formation</Button>

            <CustomizedInputBase onChange={handleChange} />
            <div >


                {faqs.map((faq, index) => (
                    <Accordion key={index} className={classes.accordeon} >
                        <AccordionSummary
                            expandIcon={<ArrowDropDownIcon style={{ fontSize: 30 }} />}
                            fontSize="large"
                        >

                            <Typography
                                className={classes.heading}
                                variant="h6"
                            >
                                <QuestionAnswerOutlinedIcon style={{ marginRight: 15 }} />
                                {ReactHtmlParser(faq[1].question)}
                            </Typography>
                        </AccordionSummary>

                        <AccordionDetails>
                            <Typography style={{ marginLeft: 30, marginRight: 50 }}>
                                {ReactHtmlParser(faq[1].reponse)}
                            </Typography>
                        </AccordionDetails>
                    </Accordion>
                ))}
            </div>
        </div>
    );
}
