import { ActiveStepActionTypes } from './activeStep.types';

const INITIAL_STATE = {
    activeStep: 1,
};

function activeStepReducer(activeStep = INITIAL_STATE, action) {
    
    switch (action.type) {
        case ActiveStepActionTypes.ACTIVE_STEP_UPDATE:
            return { ...activeStep, activeStep: action.activeStep}
        default:
            return activeStep
    }  
}

export default activeStepReducer;