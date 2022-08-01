import React from "react";
import { connect } from 'react-redux';
import ReactPlayer from "react-player";


function Video(props) {

    var sousTitre = props.info_chapitre.sous_titres;
    console.log('sousTitre   '  + sousTitre)
    return (
        <ReactPlayer
            url={"./storage/" + props.info_chapitre.fichier_video}
            playing={false}
            controls={true}
            onContextMenu={e => e.preventDefault()}
            // light={light}
            playbackRate={1}
            // onProgress={handleProgress}
            width="70%"
            height="auto"
            config={{
                file: {
                    attributes: {
                        crossOrigin: "anonymous",
                        controlsList: 'nodownload',
                    },
                    tracks: [
                        { kind: 'subtitles', src: "./storage/" + sousTitre, srcLang: 'fr', default: true, mode: 'hidden' }
                    ]
                },
            }}
        />
    );
}

const mapStateToProps = ({ chapitreData }) => {
    return {
        info_chapitre: chapitreData.chapitreData,
    }
}

export default connect(mapStateToProps)(Video);
