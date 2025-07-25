import pandas as pd
from sklearn.feature_selection import SelectKBest, f_classif
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import GaussianNB
from sklearn.tree import DecisionTreeClassifier
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import classification_report, accuracy_score
import joblib

# Load data
df = pd.read_csv('assets/fetal_health.csv')
df.columns = df.columns.str.strip()
df = df.drop_duplicates().ffill()

# Pisahkan fitur dan target
X = df.drop('fetal_health', axis=1)
y = df['fetal_health']

# Feature selection
selector = SelectKBest(score_func=f_classif, k=10)
X_selected = selector.fit_transform(X, y)
selected_features = X.columns[selector.get_support()].tolist()

# Split data
X_train, X_test, y_train, y_test = train_test_split(
    X_selected, y, test_size=0.25, random_state=42, stratify=y
)

# Model definitions
models = {
    "naive_bayes": GaussianNB(),
    "decision_tree": DecisionTreeClassifier(random_state=42),
    "random_forest": RandomForestClassifier(n_estimators=100, random_state=42),
}

accuracies = {}

# Train, evaluate, and save each model
for name, model in models.items():
    print(f"\n--- {name.upper()} ---")
    model.fit(X_train, y_train)
    y_pred = model.predict(X_test)

    acc = accuracy_score(y_test, y_pred)
    report = classification_report(y_test, y_pred, target_names=["Normal", "Suspect", "Pathological"])

    print("-- Classification Report ---")
    print(report)

    accuracies[name] = acc
    joblib.dump(model, f'{name}_model.pkl')

joblib.dump(accuracies, 'model_accuracies.pkl')
joblib.dump(selected_features, 'selected_features.pkl')

print("\nModel, selector, fitur terpilih, dan akurasi berhasil disimpan.")
