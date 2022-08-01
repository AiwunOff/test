import React, { useState, useEffect } from 'react';
import Video from '../videos/Video';
import ListeChapitres from '../ListeChapitres/ListeChapitres';
import Stepper from '../stepper/stepper';
import ChapitreDescription from '../chapitreDescription/chapitreDescription';
import Quiz from '../quiz/quiz';
import axios from "axios";
import './modules.scss';
import '../quiz/quiz.scss';
import Links from '../liens/liens';
import Faq from '../faq/faq';
import Ressource from '../ressource/ressource';
import Certificat from '../certificat/certificat';



const Wrapper = () => {

  const [view, setView] = useState('formation');
  const [faqs, setFaqs] = useState([]);
  const [ressources, setRessources] = useState([]);
  const [certificats, setCertificats] = useState([]);
  const [langue, setLangue] = useState('');


  // récupère les certiificat, ressource et faq s'ils y en a 
  // pour une formation donnée
  useEffect(() => {
    axios.get(`${globalUrl}getLiens/${idFormation}`).then((res) => {
      setFaqs(res.data['faq']);
      setCertificats(res.data['certificat']);
      setRessources(res.data['ressource']);
      setLangue(res.data['langue']);
    });
  }, []);

  
  const handleView = (vue) => {
    setView(vue);
  }

  // gère la traduction dans la page de formation construite avec react
  var localiz = [];

  if (langue && langue == 'fr') {
    localiz['prev'] = 'Précédent';
    localiz['next'] = 'Suivant';
    localiz['faq'] = 'Questions essentiels';
    localiz['res'] = 'Ressources';
    localiz['cert'] = 'Certificat';
    localiz['btnquiz'] = 'Faire le quiz';
    localiz['btndonetrue'] = 'J\'ai terminé ce chapitre';
    localiz['btndonefalse'] = 'Je n\'ai pas terminé ce chapitre';
  }

  if (langue && langue == 'en') {
    localiz['prev'] = 'Previous';
    localiz['next'] = 'Next';
    localiz['faq'] = 'Essential questions';
    localiz['res'] = 'Resources';
    localiz['cert'] = 'Certificate';
    localiz['btnquiz'] = 'Take the quiz';
    localiz['btndonetrue'] = 'I finished this chapter';
    localiz['btndonefalse'] = 'I haven\'t finished this chapter';
  }

  if (langue && langue == 'nl') {
    localiz['prev'] = 'Vorige';
    localiz['next'] = 'Volgende';
    localiz['faq'] = 'Essentiële vragen';
    localiz['res'] = 'Middelen';
    localiz['cert'] = 'Certificaat';
    localiz['btnquiz'] = 'Doe de quiz';
    localiz['btndonetrue'] = 'Hoofdstuk voltooid';
    localiz['btndonefalse'] = 'Hoofdstuk niet af';
  }
 
  var compo;
  
// affiche les composants en fonction de ce que contien le hook view
// view est défini via la fonction handleView qui est appelé sur 
// les différents composants se trouvant dans le switch ci-dessous
  switch (view) {
    case 'quiz':
      compo = <Quiz handleView={handleView} />
      break;
    case 'formation':
      compo = [<Links faqs={faqs} ressources={ressources} certificats={certificats}
        handleView={handleView} localiz={localiz}/>, <Stepper />,
      <Video />, <ListeChapitres handleView={handleView} localiz={localiz}/>,
      <ChapitreDescription />]
      break;
    case 'ressource':
      compo = <Ressource ressources={ressources} handleView={handleView} />
      break;
    case 'faq':
      compo = <Faq faqs={faqs} handleView={handleView} />
      break;
    case 'certificat':
      compo = <Certificat certificats={certificats} handleView={handleView} />
      break;
    default:
      compo = [<Links handleView={handleView} />, <Stepper />,
      <Video />, <ListeChapitres handleView={handleView} />,
      <ChapitreDescription />]
  }
  return (
    <div className="contenaireModules">
      {compo}
    </div>
  )
}

export default Wrapper;
