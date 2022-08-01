import { ChapitreActionTypes } from './chapitre.types';

export const getChapitre = (chapitre) => ({

    type: ChapitreActionTypes.GET_CHAPITRE,

    chapitre: chapitre,

}
);