import { VideosActionTypes } from './video.types';

export const getVideo = (url) => ({

    type: VideosActionTypes.GET_VIDEO,

    url_video: url,

}
);