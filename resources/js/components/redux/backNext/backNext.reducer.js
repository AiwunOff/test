import { BackNextActionTypes } from './backNext.types';

const INITIAL_STATE = {
    curChapitre: 1,
};



function backNextReducer(curChapitre = INITIAL_STATE, action) {
    
    switch (action.type) {
        case BackNextActionTypes.GET_BACKNEXT:
            return { ...curChapitre, curChapitre: action.curChapitre}
        default:
            return curChapitre
    }  
}

export default backNextReducer;