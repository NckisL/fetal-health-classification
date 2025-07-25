from flask import Flask, request, jsonify
from flask_cors import CORS
import joblib
import numpy as np

app = Flask(__name__)
CORS(app)

# Load model dan informasi lainnya
models = {
    "naive_bayes": joblib.load('naive_bayes_model.pkl'),
    "decision_tree": joblib.load('decision_tree_model.pkl'),
    "random_forest": joblib.load('random_forest_model.pkl'),
}
accuracies = joblib.load('model_accuracies.pkl')
selected_features = joblib.load('selected_features.pkl')

@app.route('/features', methods=['GET'])
def get_features():
    return jsonify({"selected_features": selected_features})

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json()
        input_features = [float(data[feature]) for feature in selected_features]
        input_array = np.array(input_features).reshape(1, -1)

        label_map = {1: "Normal", 2: "Suspect", 3: "Pathological"}
        results = []

        for name, model in models.items():
            pred = int(model.predict(input_array)[0])
            label = label_map.get(pred, str(pred))
            acc = round(accuracies[name] * 100)
            results.append({
                "model": name,
                "prediction": pred,
                "label": label,
                "accuracy": acc
            })

        return jsonify({"results": results})

    except Exception as e:
        return jsonify({"error": str(e)}), 400

if __name__ == '__main__':
    app.run(debug=True)
