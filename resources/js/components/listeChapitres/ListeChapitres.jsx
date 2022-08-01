import React, { useState, useEffect } from "react";
import { makeStyles } from '@material-ui/core/styles';
import axios from 'axios';
import SimpleList from '../simpleList/simpleList';
import BackNextButton from '../backNextButton/backNextButton';
import Button from '@material-ui/core/Button';
import CoursCompleted from '../coursCompleted/coursCompleted';
import { connect } from 'react-redux';

const useStyles = makeStyles((theme) => ({
  root: {
    width: 300,
    maxWidth: 300,
    // minHeight: 400,
    // paddingTop: 1,
    // paddingBottom: 1,
    // paddingLeft: 1,
    // paddingRight: 1,
    // backgroundColor: theme.palette.background.paper,
    // boxShadow: "-4px 9px 25px -6px rgba(0, 0, 0, 0.1)",
    // borderRadius: "0 0 10px 10px",
  },
  headerList: {
    backgroundColor: "white",
    padding: "20px",
    textAlign: "center",
    fontSize: "20px",
    lineHeight: "30px",
  },
  itemText: {
    paddingLeft: 15,
  },
  quiz: {
    width: 300,
    height: 50,
    marginTop: 20,
    border: 'solid 1px blue',
    color: "blue",
  },
}));

const ListeChapitres = (props) => {

  const classes = useStyles();
  const [chapitres, setChapitres] = useState([]);
  const [quiz, setQuiz] = useState([]);


  // idFormation est injecté dans la page indexFormations
  // dans laquelle s'affichent les composants
  useEffect(() => {
    axios.get(`${globalUrl}modulesApi/${idFormation}`)
      .then(res => {
        setChapitres(Object.entries(res.data));   
      }).catch(function (error) {
        console.log('error:   ' + error);
      });
  }, []);  
  
  // récupère le quiz du module s'il y en a pour afficher le 
  // bouton faire le quiz. Sinon on affiche pas le bouton
  useEffect(() => {
      axios.get(`${globalUrl}quizzes/quizApi/${props.info_chapitre.module_id}`)
      .then(res => {
        setQuiz(Object.values(res.data));
      });
  }, [props.info_chapitre.module_id]);



  return (
    <div className={classes.root} >
      <BackNextButton chapitres={chapitres} currentChap={1} localiz={props.localiz}/>
      <SimpleList chapitres={chapitres} init_index={0} />
      {quiz != 'hide' ? 
      <Button className={classes.quiz} variant="outlined" onClick={() => props.handleView('quiz')}>
      {props.localiz['btnquiz']}</Button> : ''
      }
      { auth[2] && <CoursCompleted localiz={props.localiz} />}
    </div>
  )
}

const mapStateToProps = ({ chapitreData }) => {
  return {
    info_chapitre: chapitreData.chapitreData,
  }
}


export default connect(mapStateToProps)(ListeChapitres);