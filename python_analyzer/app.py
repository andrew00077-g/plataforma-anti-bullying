from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Lista simple de palabras "ofensivas" (para prototipo)
OFFENSIVE = {
    'insulto': 1,
    'idiota': 2,
    'estúpido': 3,
    'matar': 3,
    'golpear': 2
}

def analyze_text(text):
    t = text.lower()
    score = 0
    found = []
    for word, weight in OFFENSIVE.items():
        if word in t:
            score += weight
            found.append(word)
    if score == 0:
        return {'flagged': False, 'severity': 'none', 'score': 0, 'found': found}
    # severity simple
    if score <= 2:
        sev = 'baja'
    elif score <= 4:
        sev = 'media'
    else:
        sev = 'alta'
    return {'flagged': True, 'severity': sev, 'score': score, 'found': found}

@app.route('/analyze', methods=['POST'])
def analyze():
    data = request.get_json() or {}
    text = data.get('text', '')
    result = analyze_text(text)
    return jsonify(result), 200

if __name__ == '__main__':
    # Ejecutar en 127.0.0.1:5000
    app.run(host='127.0.0.1', port=5000, debug=False)
