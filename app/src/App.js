import logo from './logo.svg';
import './App.css';
import { useState } from 'react';

export default function App() {
  const {alunni, setAlunni} = useState([]);
  const a = [
    {
      "id": "1",
      "nome": "claudio",
      "cognome": "benve"
    },
    {
      "id": "2",
      "nome": "ivan",
      "cognome": "bruno"
    }
  ];

  return (
    <div class="MyApp">
      <h1>ALUNNI</h1>
      { alunni.length === 0 ? (
        <button onClick={() => setAlunni(a)}>Carica Alunni</button>
      ) : (
        <table id="alunni" border="1">
          {alunni.map((a) => (
            <tr>
              <td>{a.id}</td>
              <td>{a.nome}</td>
              <td>{a.cognome}</td>
            </tr>
          ))}
        </table>
      )
    }
    </div>
  );
}
