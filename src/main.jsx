import React from 'react';
import { createRoot } from 'react-dom/client';
import './scss/_variables.scss';

function App() {
  const [count, setCount] = React.useState(0);

  return (
    <div style={{
      textAlign: 'center',
      marginTop: '50px',
      fontFamily: 'sans-serif'
    }}>
      <h2>🚀 OC Modern Theme + React + Vite</h2>
      <p>React is running inside WordPress ✅</p>
      <button
        style={{
          backgroundColor: '#0073aa',
          color: '#fff',
          border: 'none',
          padding: '10px 20px',
          borderRadius: '8px',
          cursor: 'pointer',
          marginTop: '20px'
        }}
        onClick={() => setCount(c => c + 1)}
      >
        Clicked {count} times
      </button>
    </div>
  );
}

// Mount into #oc-root (from index.php)
const root = document.getElementById('oc-root');
if (root) {
  createRoot(root).render(<App />);
}

export default App;
