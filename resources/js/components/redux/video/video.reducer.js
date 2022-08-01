import { VideosActionTypes } from './video.types';

const INITIAL_STATE = {
    url_video: '',
};

const videoReducer = (url_video = INITIAL_STATE, action) => {

    switch (action.type) {
        case VideosActionTypes.GET_VIDEO:

            return { ...url_video, url_video: action.url_video };

        default:

            return url_video;
    }
};

export default videoReducer;
