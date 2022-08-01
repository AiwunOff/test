/* eslint-disable jsx-a11y/anchor-is-valid */
import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import InfoIcon from '@material-ui/icons/Info';
import PeopleIcon from '@material-ui/icons/People';
import VerifiedUserIcon from '@material-ui/icons/VerifiedUser';



const useStyles = makeStyles((theme) => ({
    root: {
        // border: 'blue solid 2px',
        width: "100%",
        marginBottom: '40px',
        display: "flex",
        flexDirection: "row",
        flexWrap: "wrap",
        justifyContent: "flex-start",
        alignItems: "flex-start",
    },
    lien: {
        marginRight: 35,
        fontSize: "18px",
        color: "#005caa",
        display: "inline",
        display: "flex",
        flexDirection: "row",
        justifyContent: "flex-start",
        alignItems: "center",
        '&:hover': {
            cursor: "pointer",
            textDecoration: 'underline',
        },
    },
    icon: {
        marginRight: 8,
        fontSize: "22px",
    },
}));

export default function Links(props) {
    const classes = useStyles();

     // on affiche les liens que lorsqu'il y a quelque chose à afficher
    return (
        <div className={classes.root} >
            {props.faqs != 'hide' && props.faqs != '' ?
                <Typography className={classes.lien} onClick={() => props.handleView('faq')}>
                    <InfoIcon className={classes.icon} />{props.localiz['faq']}
        </Typography> : ''
            }
            {props.ressources != 'hide' && props.ressources != '' ?
                <Typography className={classes.lien} onClick={() => props.handleView('ressource')}>
                    <PeopleIcon className={classes.icon} /> {props.localiz['res']}
        </Typography> : ''
            }
            {props.certificats != 'hide' && props.certificats != '' ?
                <Typography className={classes.lien} onClick={() => props.handleView('certificat')}>
                    <VerifiedUserIcon className={classes.icon} /> {props.localiz['cert']}
        </Typography> : ''
            }
        </div>
    );
}
