import yaml

# Chargement du fichier YAML
with open('app/Provider/extrait.yml', 'r') as stream:
    try:
        data = yaml.safe_load(stream)
    except yaml.YAMLError as exc:
        print(exc)
# Manipulation des données YAML
print(data)  # Affiche les données chargées depuis le fichier YAML
