import { TitreChapitreActionTypes } from './titreChapitre.types';

const INITIAL_STATE = {
    titreChapitre: '',
};



function titreChapitreReducer(titreChapitre = INITIAL_STATE, action) {
    
    switch (action.type) {
        case TitreChapitreActionTypes.GET_TITRECHAPITRE:
            return { ...titreChapitre, titreChapitre: action.titreChapitre}
        default:
            return titreChapitre
    }  
}

export default titreChapitreReducer;