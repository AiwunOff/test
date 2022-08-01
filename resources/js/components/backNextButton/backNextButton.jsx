import React, { useState, useEffect } from "react";
import { makeStyles } from '@material-ui/core/styles';
import Button from '@material-ui/core/Button';
import store from '../redux/store'
import { connect } from 'react-redux';



const useStyles = makeStyles((theme) => ({
  root: {
    width: 300,
    boxShadow: "-4px 9px 25px -6px rgba(0, 0, 0, 0.1)",
  },
  backButton: {
    width: 150,
    height: 50,
    borderRadius: `10px 0 0 0`,
    "&:focus": {
      outline: 'none',
    },
    backgroundColor: theme.palette.background.paper,
  },
  nextButton: {
    width: 150,
    height: 50,
    borderRadius: `0 10px 0 0`,
    "&:focus": {
      outline: 'none',
    },
    backgroundColor: theme.palette.background.paper,
  },
}));

const BackNextButton = (props) => {

  const classes = useStyles();
  const [curChapitre, setCurChapitre] = useState(0);
  const [activeStep, setActiveStep] = useState(1);
  // met le premier chapitres de chaque modules dans modTab
  var modId = 0;
  var modTab = [];
  var chapi;
  // props.chapitres.map(chapitre => arrChap.push(chapitre[1]));
  props.chapitres.map(chapitre => {
    if (modId == 0) {
      modTab.push(chapitre[1]);
      modId = 1;
    }
    if (modId != chapitre[1].module_id) {
      modTab.push(chapitre[1]);
      ++modId;
    }
  })
  // récupère le nombre de modules pour désactiver le bouton "suivant" quand on atteint nbModules
  var nbModules = modTab.length ? modTab.length : 5;

  // INITIALISATION :envoie le premier chapitre au store pour déclencher le chargement 
  // de la 1er vidéo, titre et description du premier module 
  // si il y a des props.chapitres mais qu'il n'y en a pas dans le store
  useEffect(() => {
    if (props.chapitres[0] && !props.info_chapitre.module_ordre) {
      store.dispatch({ type: 'GET_CHAPITRE', chapitreData: props.chapitres[0][1] });
    }
  });


  // modifie activeStep pour positionner le bon onglet "précédent / suivant"
  // useEffect(() => {
  //   setActiveStep(props.info_chapitre.module_ordre);
  // }, [props.info_chapitre.module_ordre]);

  // met à jour le store avec le premier chapitre du module sélectionné
  useEffect(() => {
      // store.dispatch({ type: 'GET_CHAPITRE', chapitreData: modTab[props.store_curChapitre] });
      store.dispatch({ type: 'GET_BACKNEXT', curChapitre: props.info_chapitre.module_ordre - 1});
  }, [props.info_chapitre.module_ordre]);

  //passe au module suivant
  const handleNext = () => {
    // setCurChapitre(curChapitre + 1);
    store.dispatch({ type: 'GET_CHAPITRE', chapitreData: modTab[props.store_curChapitre + 1] });
    // store.dispatch({ type: 'GET_BACKNEXT', curChapitre: props.store_curChapitre + 1});
    
  };

  //passe au module précédent
  const handleBack = () => {
    // setCurChapitre(curChapitre - 1);
    store.dispatch({ type: 'GET_CHAPITRE', chapitreData: modTab[props.store_curChapitre - 1] });
    // store.dispatch({ type: 'GET_BACKNEXT', curChapitre: props.store_curChapitre - 1});
    
  };

  return (
    <div className={classes.root}>
      <div>
        <Button
          disabled={props.store_curChapitre < 1}
          onClick={handleBack}
          className={classes.backButton}
        // variant="contained"
        >
          {props.localiz['prev']}
              </Button>
        <Button
          disabled={props.store_curChapitre == nbModules - 1}
          // variant="contained"
          className={classes.nextButton}
          onClick={handleNext}>
          {props.localiz['next']}
                </Button>
      </div>
    </div>
  );
}



const mapStateToProps = ({ chapitreData, curChapitre }) => {
  return {
    info_chapitre: chapitreData.chapitreData,
    store_curChapitre: curChapitre.curChapitre,
  };
};

export default connect(mapStateToProps)(BackNextButton);
