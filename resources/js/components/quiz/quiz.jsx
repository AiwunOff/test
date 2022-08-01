import React, { useState, useEffect } from "react";
import './quiz.scss';
import { makeStyles } from '@material-ui/core/styles';
import FormLabel from '@material-ui/core/FormLabel';
import axios from 'axios';
import Paper from '@material-ui/core/Paper';
import InputQuiz from '../formulaire/InputQuiz'
import { connect } from 'react-redux';
import Divider from '@material-ui/core/Divider';
import Button from '@material-ui/core/Button';
import ModalFooterButton from '../modalFooterButton/modalFooterButton';
import Register from '../register/register';
import Login from '../login/login';

const useStyles = makeStyles((theme) => ({
  root: {
    display: 'flex',
    flexDirection: "column",
    flexWrap: "nowrap",
    justifyContent: "flex-start",
    alignItems: "center",
    width: '100%',
    paddingLeft: '10%',
    paddingRight: '10%',
    paddingBottom: '70px',
  },
  formLabel: {
    fontSize: '22px',
    fontWeight: 'bold',
    lineHeight: '30px',
    marginBottom: '20px',
    marginTop: '20px',
  },
  formLabelError: {
    color: 'red',
    fontWeight: '400',
  },
  reponses: {
    fontSize: '16px',
    lineHeight: '22px',
  },
  paper: {
    width: '100%',
    paddingLeft: '10%',
    paddingRight: '10%',
    paddingBottom: '40px',
    paddingTop: '50px',
    boxShadow: "-4px 9px 25px -6px rgba(0, 0, 0, 0.1)",
    // marginTop: "-50px",
  },
  submitButton: {
    width: 'auto',
    marginTop: '30px',
    paddingTop: '7px',
    paddingBottom: '7px',
    backgroundColor: 'black',
    color: 'white',
  },
  divid: {
    marginTop: '10px',
    marginBottom: '10px',
  },

}));


const Quiz = (props) => {
  const classes = useStyles();
  const [quizzes, setQuizzes] = useState([]);
  const [score, setScore] = useState(0);
  const [messageScore, setMessageScore] = useState('');
  const [messageFooter, setMessageFooter] = useState('');
  const [titreButton0, setTitreButton0] = useState('');
  const [titreButton1, setTitreButton1] = useState('');
  const [titreButton2, setTitreButton2] = useState('');
  const [functionModalButton, setFunctionModalButton] = useState('');
  const [idQuiz, setIdQuiz] = useState([]);
  var val = 0;
  // charge le quiz correspondant au module_id courrant
  // avec ses relations questions et reponses
  useEffect(() => {
    axios.get(`${globalUrl}quizzes/quizApi/${props.info_chapitre.module_id}`)
      .then(res => {
        setQuizzes(Object.entries(res.data));
        setIdQuiz(res.data[0].questions[0].quiz_id);

      });
  }, []);

  // on récupère l'id de toutes les questions dans allQuestionsId pour pouvoir 
  // faire les validations en comparant le question_id de chaque reponse
  // au contenu de allQuestionsId. module_id doit apparaitre au moins
  // une fois pour chaque questions sinon invalidation

  var allQuestionsId = [];

  quizzes.map((quiz) => {
    quiz[1].questions.map(question => {
      question.reponses.map((reponse) => allQuestionsId.indexOf(reponse.question_id) === -1
        && allQuestionsId.push(reponse.question_id))
    })
  }
  )

  // crée un objet avec toutes les reponse.id comme clé et les  question.id comme value
  var reponses_Questions = {};
  quizzes.map((quiz) => {
    quiz[1].questions.map(question => {
      question.reponses.map((reponse) => reponses_Questions[reponse.id] = question.id)
    })
  }
  )
  // fournie l'id de la question dont la réponse est en paramètre
  const getQuestion = (idReponse) => {
    var questId;
    for (var prop in reponses_Questions) {
      prop == idReponse && (questId = reponses_Questions[prop]);
    }
    return questId;
  }

  // vérifie si on a répondu à toutes les questions 
  // sinon renvoi l'id des questions sans réponse 
  var questionMissing = [];

  const formValidation = (userRep) => {
    var userQuestion = [];
    // userQuestion reçoit l'id des questions correspondantes
    // aux réponses données
    for (let i = 0; i <= userRep.length - 1; i++) {
      userQuestion.push(getQuestion(userRep[i]))
    }

    // si userQuestion ne contient pas une allQuestionId
    // cela veut dire qu'on y a pas répondue.
    var count = 0;
    for (var i = 0; i <= allQuestionsId.length - 1; i++) {
      count = 0;
      for (var j = 0; j <= userQuestion.length - 1; j++) {
        if (userQuestion[j] == allQuestionsId[i]) {
          count++;
        }
      }
      if (count == 0) {
        questionMissing.push(allQuestionsId[i])
      }
    }

    //met en rouge les questions sans réponses
    if (questionMissing.length) {
      for (let i = 0; i <= questionMissing.length - 1; i++) {
        document.getElementById('questionId_' + questionMissing[i]).classList.add(classes.formLabelError);
      }

      //ouvre une modal pour signaler qu'il faut répondre à toutes les questions
      var modal = document.getElementById("myModal");
      modal.style.display = "block";

      var span = document.getElementsByClassName("close")[0];
      span.onclick = function () {
        modal.style.display = "none";
      }

      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    }
  }

  var value = 0;
  const valFunc = (userReponseVar) => {

    for (var i = 0; i <= quizzes[0][1].questions.length - 1; i++) {
      for (var j = 0; j <= quizzes[0][1].questions[i].reponses.length - 1; j++) {
        for (var k = 0; k <= userReponseVar.length - 1; k++) {
          if (userReponseVar[k] == quizzes[0][1].questions[i].reponses[j].id) {
            value = value + Number(quizzes[0][1].questions[i].reponses[j].value);
          }
        }
      }
    }
    
    return Number(value);
  }


  var userReponseVar = [];
  // gère l'envoi du quiz ------------------------------------->
  function handleSubmit(event) {
    val = 0;
    userReponseVar = [];
    event.preventDefault();

    for (let i = 0; i <= event.target.length; i++) {
      if (event.target[i] && event.target[i].checked) {
        userReponseVar.push(event.target[i].value);
      }
    }

    formValidation(userReponseVar);

    // s'il n'y a pas de questions manquantes 
    // affiche une modal avec le score du quiz
    if (questionMissing.length == 0) {
      
      val = Number(valFunc(userReponseVar));
      setScore(Math.ceil((val / allQuestionsId.length) * 100)); 
      var scoreTest = Math.ceil((val / allQuestionsId.length) * 100);

      if (scoreTest >= 80) {
        setMessageScore('Félicitation, votre score est de ' + scoreTest + '%');
      }
      if (scoreTest < 80) {
        setMessageScore('Pour valider ce module vous devez obtenir un score de 80 % minimum. Votre score est de ' + scoreTest + '%');
      }

      // si le score est < 80 on affiche pas de message dans le footer de la modal
      score >= 80 ? setMessageFooter('Voulez-vous sauvegarder votre score ?')
        : setMessageFooter('    ');
      setTitreButton0('hide');
      setTitreButton1('Enregistrer');
      setTitreButton2('Quitter');
      setFunctionModalButton('saveQuiz');
      handelModal();
    }

    questionMissing.length = 0;

  }

  // force le bon fonctionnement de la modal mYmodal2 ------------------------------->
  const closeModal = () => {

    document.getElementById("myModal2").style.display = "none";
    // props.handleQuizClick();
    props.handleView('formation');

  }

  // gère la sauvegarde des résultats du quiz -------------------------------->
  const handleSaveQuiz = () => {
    if (auth == 0) {
      setMessageScore('vous devez être enregisté (e) pour sauvegarder vos résultats');
      setMessageFooter('');
      setTitreButton0('je suis déjà inscrit (e)');
      setTitreButton1('S\'inscrire');
      setTitreButton2('Quitter');
      setFunctionModalButton('inscription');
      handelModal();
    } else {
      axios.post(`${globalUrl}reponses_user`,
        { resultat: score, id: auth[2], quiz_id: idQuiz })
        .then(function (response) {
          console.log('success   ' + response.data);
          document.getElementById("myModal2").style.display = "none";
        })
        .catch(function (error) {
          console.log('probleme   ' + error);
        });
    }
  }


  // gère la connexion et la sauvegarde des résultats du quiz -------------------------------->
  const login = () => {
    setMessageScore('Enregister mes résultats');
    setFunctionModalButton('connexion');
    handelModal();
  }

  // --------------------------------------------------------->
  const register = () => {
    setMessageScore('Enregistrez-vous');
    handelModal();
  }

  // affiche et gère la modal ---------------------------------------->
  const handelModal = () => {
    var modalScore = document.getElementById("myModal2");
    modalScore.style.display = "block";

    var span = document.getElementsByClassName("close2")[0];
    span.onclick = function () {
      modalScore.style.display = "none";
    }

    var button2 = document.getElementsByClassName("button2")[1];
    button2.onclick = function () {
      modalScore.style.display = "none";
      props.handleQuizClick();
    }

    window.onclick = function (event) {
      if (event.target == modalScore) {
        modalScore.style.display = "none";
      }
    }
  }


  return (
    <div className={classes.root}>

      {/* affiche l'erreur quiz non complet */}
      <div id="myModal" className="modal">
        <div className="modal-content">
          <div className="headerModal"><span className="close">x</span></div>
          <p>Vous devez répondre à toutes les questions du quiz !</p>
          <div className="footerModal"></div>
        </div>
      </div>


      {/* affiche le résultat du quiz */}
      <div id="myModal2" className="modal2">
        <div className="modal-content2">

          <div className="headerModal2"><span className="close2">x</span></div>
          <p> {messageScore} </p>
          {messageScore == 'Enregistrez-vous' ? <Register resultat={score} quiz_id={idQuiz} /> :
            messageScore == 'Enregister mes résultats' ?
              <Login resultat={score} quiz_id={idQuiz} handleView={props.handleView} /> :
              <ModalFooterButton message={messageFooter}
                titre0={titreButton0} titre1={titreButton1} titre2={titreButton2}
                func={functionModalButton == 'saveQuiz' ? handleSaveQuiz : register}
                func2={functionModalButton == 'saveQuiz' ? 'hide' : login}
                closeModal={closeModal}
                score={score}
              />
          }

        </div>
      </div>


      <div className="quizHeader">
        <Button onClick={() => props.handleView('formation')} variant="outlined" className="quizBackButton">
          Revenir sur la page de formation</Button>
      </div>


      <Paper className={classes.paper}>
        <h1 className="paperH1">Quiz du module: {props.info_chapitre.module_titre}</h1>
        <form className={classes.container} onSubmit={handleSubmit} >
          {quizzes.map((quiz) =>
            <div key={quiz[1].id}>
              {quiz[1].questions.map((question, ndx) =>
                <div key={ndx}><FormLabel className={classes.formLabel} id={'questionId_' + question['id']}>
                  {question['question']}</FormLabel>
                  {question.reponses.map((reponse, ndx) =>
                    <InputQuiz
                      typeInput={question.type}
                      iscorrect={reponse.is_correct}
                      value={reponse.reponse}
                      name={reponse.question_id}
                      ndx={ndx}
                      id={reponse.id}
                      key={ndx}
                    />
                  )} <Divider />
                </div>
              )}
            </div>
          )}
          <button className={classes.submitButton} type="submit" >Envoyer</button>
        </form>
      </Paper>
    </div>
  );
}


const mapStateToProps = ({ chapitreData }) => {
  return {
    info_chapitre: chapitreData.chapitreData,
  }
}


export default connect(mapStateToProps)(Quiz);
