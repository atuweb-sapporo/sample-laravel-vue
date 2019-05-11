import Firebase from 'firebase'
import FirebaseSettings from '../../../data/firebase-frontend.json';

let firebaseApp = Firebase.initializeApp(FirebaseSettings);
