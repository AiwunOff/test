import React from "react";
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import { connect } from 'react-redux';
import ReactHtmlParser from 'react-html-parser';
import '../style/description.scss';

const useStyles = makeStyles((theme) => ({
  root: {
    width: '70%',
    marginTop: '5px',
  },
}));

const ChapitreDescription = (props) => {
  const classes = useStyles();

  // ReactHtmlParser permet d'afficher correctement du html provenant de ckeditor sans afficher les balises
  return (
    <div className={classes.root }>
      {/* <Typography className={classes.instructions}>{ ReactHtmlParser(props.description_chapitre.description) }</Typography> */}
      { ReactHtmlParser(props.description_chapitre.description) }
    </div>
  );
}

const mapStateToProps = ({ chapitreData }) => {
  return {
    description_chapitre: chapitreData.chapitreData,
  };
};

export default connect(mapStateToProps)(ChapitreDescription);
