import React, { useState, useEffect } from "react";
import { makeStyles } from '@material-ui/core/styles';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';
import { connect } from 'react-redux';
import axios from "axios";
import Tooltip from '@material-ui/core/Tooltip';
import store from '../redux/store';
import './stepper.scss';
import { styled } from '@material-ui/core/styles';
 

const MyButton = styled(Button)({
  width: 100,
  height: "20px",
  flex: "1",
  minWidth: '2px',
});

const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    height: "100px",
    display: "flex",
    flexDirection: "row",
    flexWrap: "wrap",
    justifyContent: "center",
    alignItems: "flex-start",
    
    // backgroundColor: 'rgb(255, 244, 244)',
    // border: 'primary solid 2px',
  },
  stepper: {
    display: "flex",
    flexDirection: "row",
    flexWrap: "wrap",
    justifyContent: "center",
    alignContent: "stretch",
    // alignItems: "stretch",
    // alignContent: "stretch",
    // width: "100%",
    // marginBottom: "20px",
    // border: 'green solid 2px',
  },
  // stepButton: {
  //   height: 20,
  //   width: 100,
  //   "&:focus": {
  //     outline: 'none',
  //     backgroundColor: "blue",
  //   },
  //   flex: '1',
  //   backgroundColor: "red",
  // },
  blockTitre: {
    display: "flex",
    width: "100%",
    justifyContent: "flex-start",
    alignItems: "center",
  },
  titre: {
    fontSize: 30,
    marginBottom: 0,
    fontWeight: "bold",
    marginTop: "15px",
  },
  selected: {
    backgroundColor: "blue",
  }
}));

var style = '';

const Stepper = (props) => {
  const classes = useStyles();
  const classes2 = useStyles();
  const [chapitres, setChapitres] = useState([]);
  const [id, setId] = useState(1);

  // récupère tous les chapitres de la formation dont l'id est = idFormation
  // idFormation est injecté dans la page indexFormation
  useEffect(() => {
    axios.get(`${globalUrl}modulesApi/${idFormation}`)
      .then(res => {
        setChapitres(Object.entries(res.data));
        setId(props.store_chapitre.id);
      });
  }, []);

  // set id avec l'id du chapitre dans le store pour positionner le 
  // curseur du stepper quand on clique dans la liste
  useEffect(() => {
    setId(props.store_chapitre.id);
  }, [props.store_chapitre.id]);


  // positionne le curseur sur le stepper cliqué et envoi son chapitre
  // dans le store pour mettre à jour BackNextButton et SimpleList
  const locateStepper = (chapitre) => {
    setId(chapitre.id);
    store.dispatch({ type: 'GET_CHAPITRE', chapitreData: chapitre });
  };

   
  const colorSelected = (idChapitre) => {
    if (idChapitre === id) { style = { backgroundColor: "blue" } }
    else if (props.store_dejaSuivi.includes(idChapitre)) { style = { backgroundColor: '#f1f1f1' } }
    else { style = { backgroundColor: '#ffffff' } }
    return style;
  }

  // bulle info
  const useStylesBootstrap = makeStyles((theme) => ({
    arrow: {
      color: theme.palette.common.black,
    },
    tooltip: {
      backgroundColor: theme.palette.common.black,
      maxWidth: 220,
      fontSize: '16px',
    },
  }));
  // bulle info
  function BootstrapTooltip(props) {
    const classes = useStylesBootstrap();
    return <Tooltip arrow classes={classes} {...props} />;
  }

  return (
    <div className={classes.root}>
      <div className={classes.stepper}>
        {chapitres.map((chapitre, index) => (
          <BootstrapTooltip key={index} title={chapitre[1].titre} placement="top">
            <MyButton className={classes2.stepButton} 
              onClick={() => locateStepper(chapitre[1])}
              variant="outlined" color="primary"
              style={colorSelected(chapitre[1].id)}
            >
            </MyButton>       
          </BootstrapTooltip>
        ))}
      </div>
      <div className={classes.blockTitre}>
        <Typography className={classes.titre}>{props.store_chapitre.titre}</Typography>
      </div>
    </div>
  );
}

const mapStateToProps = ({ chapitreData, dejaSuivi }) => {
  return {
    store_chapitre: chapitreData.chapitreData,
    store_dejaSuivi: dejaSuivi.dejaSuivi,
  };
};

export default connect(mapStateToProps)(Stepper);
