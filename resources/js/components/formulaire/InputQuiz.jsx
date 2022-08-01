import React from "react";
import './InputQuiz.scss';
import { makeStyles } from '@material-ui/core/styles';

const useStyles = makeStyles((theme) => ({
  root: {
    // display: 'flex',
    // width: '100%',
  },
  reponses: {
    fontSize: '18px',
    lineHeight: '30px',
    marginLeft: '15px',
  }
}));

const InputQuiz = (props) => {
  const classes = useStyles();
  const { name, value, id, typeInput, ndx } = props

  // ici on différencie les checkbox et les radios pour attribuer
  // un name différent pour les checkbox et identique pour les radios
  // du même groupe
  const trueName = typeInput === 'checkbox' ? name + ndx : name

  return (
    <div className="InputQuiz" >
      <input type={typeInput} name={trueName} id={id} value={id} />
      <label className={classes.reponses} htmlFor={id}>{value}</label>
    </div>
  )
}

export default InputQuiz;
