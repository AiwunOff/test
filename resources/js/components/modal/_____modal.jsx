import React from "react";

const Modal = (props) => {

    return (
        <div id="myModal" class="modal">

            <div class="modal-content">

                <div class="headerModal"><button class="close">x</button></div>

                <p> {props.messageScore} {props.score} %</p>

                <div class="footerModal">
                    <p> Voulez-vous sauvegarder votre score ?</p>
                    <button>Sauvegarder</button>
                    <button>Annuler</button>
                </div>

            </div>

        </div>
    )
}

export default Modal;