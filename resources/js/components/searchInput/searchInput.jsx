import React, { useState, useEffect } from "react";
import { makeStyles } from '@material-ui/core/styles';
import Paper from '@material-ui/core/Paper';
import InputBase from '@material-ui/core/InputBase';
import Divider from '@material-ui/core/Divider';
import IconButton from '@material-ui/core/IconButton';
import SearchIcon from '@material-ui/icons/Search';
import ClearIcon from '@material-ui/icons/Clear';


const useStyles = makeStyles((theme) => ({
  root: {
    padding: '2px 4px',
    display: 'flex',
    alignItems: 'center',
    width: '98%',
    height: '60px',
    marginBottom: '50px',
    marginTop: '50px',
    // boxShadow: "-4px 9px 25px -6px rgba(0, 0, 0, 0.1)",
    border: "solid 1px #e0e0e0",
    boxShadow: "none",
  },
  input: {
    marginLeft: theme.spacing(1),
    flex: 1,
  },
  iconButton: {
    padding: 10,
  },
  divider: {
    height: 28,
    margin: 4,
  },
}));


export default function CustomizedInputBase(props) {

  const classes = useStyles();

  return (
    <Paper component="form" className={classes.root}>
      <InputBase
        className={classes.input}
        placeholder="Rechercher"
        onChange={props.onChange}
      />
      <SearchIcon   style={{ fontSize: 27, opacity: 0.7 }}/>
      <Divider className={classes.divider} orientation="vertical" />
      <IconButton onClick={props.onChange} type="reset" color="primary" className={classes.iconButton} aria-label="directions">
        <ClearIcon />
      </IconButton>
    </Paper>
  );
}
