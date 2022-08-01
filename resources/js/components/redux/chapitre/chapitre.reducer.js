import { ChapitreActionTypes } from './chapitre.types';

const INITIAL_STATE = {
    chapitreData: {},
};



function chapitreReducer(chapitreData = INITIAL_STATE, action) {
    
    switch (action.type) {
        case ChapitreActionTypes.GET_CHAPITRE:
            return { ...chapitreData, chapitreData: action.chapitreData }
        default:
            return chapitreData
    }  
}

export default chapitreReducer;