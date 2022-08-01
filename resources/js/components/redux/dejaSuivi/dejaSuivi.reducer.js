import { DejaSuiviActionTypes } from './dejaSuivi.types';
import axios from "axios";

var chapitreSuivi = [];
var chapTab = [];

axios.get(`${globalUrl}chapitreSuiviList`, {
      params: {
        id: auth[2],
      }
    })
      .then(res => {
        chapitreSuivi = Object.entries(res.data);
        chapitreSuivi.map((chap) => chapTab.push(chap[1].chapitre_id));
      });


const INITIAL_STATE = {
    dejaSuivi: chapTab,
};

function dejaSuiviReducer(dejaSuivi = INITIAL_STATE, action) {
    
    switch (action.type) {
        case DejaSuiviActionTypes.DEJA_SUIVI:
            return { ...dejaSuivi, dejaSuivi: action.dejaSuivi }
        default:
            return dejaSuivi
    }  
}

export default dejaSuiviReducer;