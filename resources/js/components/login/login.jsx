import React, { useState } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import axios from 'axios';
import '../quiz/quiz.scss';


const useStyles = makeStyles((theme) => ({
    root: {
        '& > *': {
            width: '80%',
            marginBottom: "15px",
        },
        display: "flex",
        flexDirection: "column",
        flexWrap: "nowrap",
        justifyContent: "space-arround",
        alignItems: "center",
        paddingBottom: "70px",
        "& .MuiFilledInput-root": {
            background: "rgb(232, 241, 250)"
        }
    },
    button: {
        width: "150px",
        height: "45px",
        marginTop: "20px",
    },
    input: {
        marginTop: "15px",
    }
}));

export default function Login(props) {
    const classes = useStyles();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
  

    const handleChangeEmail = (event) => {
        setEmail(event.target.value);
    };
    const handleChangePassword = (event) => {
        setPassword(event.target.value);
    };


    const handleSubmit = (event) => {
        event.preventDefault();
        var data = '';

        axios.post(`${globalUrl}checkUser`,
            { email: email, password: password }
        )
            .then(res => {
                data = res.data;
                console.log('data   ' + data);
                if (data != 'user not exist') {
                    axios.post(`${globalUrl}reponses_user`,
                        { resultat: props.resultat, id: data, quiz_id: props.quiz_id })
                        .then(function (response) {
                            console.log('success   ' + response.data);
                            document.getElementById("myModal2").style.display = "none";
                            window.location.reload();
                        })
                        .catch(function (error) {
                            console.log('probleme   ' + error);
                        });
                } else {
                    handelModalW();
                }

            })
            .catch(function (error) {
                handelModalW();
                console.log('probleme   ' + error);
            });

            props.handleView('formation');
    }

    // affiche et gère la modal ---------------------------------------->
    const handelModalW = () => {
        var modalW = document.getElementById("myModalW");
        console.log('modalW   ' + modalW)
        modalW.style.display = "block";

        var span = document.getElementsByClassName("closeW")[0];
        span.onclick = function () {
            modalW.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modalW) {
                modalW.style.display = "none";
            }
        }
    }

    // enlève la couleur de fond des inputs quand ils sont remplis
    const inputStyle = { WebkitBoxShadow: "0 0 0 1000px white inset" };

    return (
        <div>
            {/* aFfiche erreur de login */}
            <div id="myModalW" className="modal">
                <div className="modal-content">
                    <div className="headerModalW"><span className="closeW">x</span></div>
                    <p>Vos données sont incorrectes</p>
                    <div className="footerModal"></div>
                </div>
            </div>

            <form className={classes.root} >
                <h2>Introduisez votre adresse email et votre mot de passe</h2>
                <TextField id="email" label="Email" variant="outlined" onChange={handleChangeEmail}
                    required className={classes.input} inputProps={{ style: inputStyle }} />
                <TextField id="password" label="Mot de passe" variant="outlined" type="password"
                    onChange={handleChangePassword} required className={classes.input} inputProps={{ style: inputStyle }} />
                <Button type="submit" variant="outlined" className={classes.button} onClick={handleSubmit}>
                    Envoyer
                </Button>
            </form>
        </div>
    );
}


