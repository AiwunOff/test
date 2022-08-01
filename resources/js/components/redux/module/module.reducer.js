import { ModuleActionTypes } from './module.types';

const INITIAL_STATE = {
    module_id: 1,
};

function moduleReducer(module_id = INITIAL_STATE, action) {
    
    switch (action.type) {
        case ModuleActionTypes.INC_MODULE_ID:
            return { ...module_id, module_id: action.module_id + 1 }
        case ModuleActionTypes.DEC_MODULE_ID:
            return { ...module_id, module_id: action.module_id - 1 }
        case ModuleActionTypes.SELECT_MODULE_ID:
            return { ...module_id, module_id: action.module_id }
        default:
            return module_id
    }  
}

export default moduleReducer;