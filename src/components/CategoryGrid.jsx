import React, { useEffect, useState } from 'react';

export default function CategoryGrid() {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('/wp-json/wc/store/v1/products?per_page=6')
      .then((res) => res.json())
      .then((data) => {
        setProducts(data);
        setLoading(false);
      });
  }, []);

  if (loading) return <p style={{ textAlign: 'center' }}>Loading products...</p>;

  return (
    <div style={{
      display: 'grid',
      gridTemplateColumns: 'repeat(auto-fill, minmax(200px, 1fr))',
      gap: '20px',
      padding: '20px'
    }}>
      {products.map((p) => (
        <div key={p.id}
          style={{
            border: '1px solid #ddd',
            borderRadius: '8px',
            padding: '10px',
            textAlign: 'center'
          }}
        >
          <img
            src={p.images?.[0]?.src}
            alt={p.name}
            style={{ width: '100%', height: '180px', objectFit: 'cover', borderRadius: '6px' }}
          />
          <h3 style={{ fontSize: '16px', margin: '10px 0' }}>{p.name}</h3>
          <strong>{p.prices.price / 100} ₪</strong>
        </div>
      ))}
    </div>
  );
}
