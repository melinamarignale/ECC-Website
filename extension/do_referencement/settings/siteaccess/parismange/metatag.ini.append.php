<?php /* #?ini charset="utf-8"?

[AttributesMapping]
DefaultName[]
DefaultName[]=name
DefaultName[]=short_name

DefaultDescription[]
DefaultDescription[]=description
DefaultDescription[]=short_description

DefaultKeywords[]
DefaultKeywords[]=keywords




SpecialMapping[]
SpecialMapping[]=restaurant
SpecialMapping[]=restaurant|page=avis
SpecialMapping[]=restaurant|page=photos
SpecialMapping[]=restaurant|page=contact
SpecialMapping[]=gourmandise
SpecialMapping[]=gourmandise|page=avis
SpecialMapping[]=gourmandise|page=photos
SpecialMapping[]=gourmandise|page=contact
SpecialMapping[]=dossier_restaurant
SpecialMapping[]=dossier_restaurant|filtre=gourmandises
SpecialMapping[]=dossier_restaurant|filtre=restaurants
SpecialMapping[]=dossier_restaurant|filtre=coup_coeur


MetatagAttributeIdentifier=meta_tag

FillOnPublish=disabled
# Désactive la surcharge de mapping pour une liste de classes
# Permet de faire exception au circuit de surcharge général

DisableMapping[]
#DisableMapping[]=personnalite
#DisableMapping[]=film

#Retourne uniquement les valeurs contenus dans l'attribut metatag sans mapping
#MetatagOnlyMapping[]
#MetagOnlyMapping[]=blog


[restaurant]
NamePattern= Restaurant {nom}  / {cp} Paris
DescriptionPattern=Notre avis sur {nom} {cp} Paris / {description}  Notre critique sur le restaurant Restaurant {nom} Paris {adresse} {cp} {description} Type de cuisine {type_cuisine}
KeywordsPattern=

[restaurant|page=avis]
NamePattern=Tous les avis sur {nom} / {cp} Paris
DescriptionPattern=Tous les avis sur le restaurant {nom} Paris {adresse} {cp} {description}
KeywordsPattern=

[restaurant|page=photos]
NamePattern=Les photos du restaurant {nom} / {cp} Paris
DescriptionPattern=Photos et diaporama du restaurant {nom} Paris {adresse} {cp} {description}
KeywordsPattern=

[restaurant|page=contact]
NamePattern=Telephone, adresse et informations pratiques sur {nom} / {cp} Paris
DescriptionPattern=Les informations pratiques sur le restaurant {nom} Paris {adresse} {cp} {description}
KeywordsPattern=


[gourmandise]
NamePattern= {nom}  / {cp} Paris
DescriptionPattern={description}  Notre critique sur {nom} Paris {adresse} {cp} {description} Type de cuisine {type_cuisine}
KeywordsPattern=

[gourmandise|page=avis]
NamePattern=Tous les avis sur {nom} / {cp} Paris
DescriptionPattern=Tous les avis sur {nom} Paris {adresse} {cp} {description}
KeywordsPattern=

[gourmandise|page=photos]
NamePattern=Les photos de l'établissement {nom} / {cp} Paris
DescriptionPattern=Photos et diaporama de l' établissement {nom} Paris {adresse} {cp} {description}
KeywordsPattern=

[gourmandise|page=contact]
NamePattern=Telephone, adresse et informations pratiques sur {nom} / {cp} Paris
DescriptionPattern=Les informations pratiques sur {nom} Paris {adresse} {cp} {description}
KeywordsPattern=

[dossier_restaurant]
NamePattern={nom}
DescriptionPattern=Notre selection de restaurants et de gourmandise parisiennes {nom} {code_postal} {type_cuisine}
KeywordsPattern=

[dossier_restaurant|filtre=gourmandises]
NamePattern={nom} / la selection gourmandises Parismange
DescriptionPattern=la selection gourmandises Parismange {nom} {code_postal} {type_cuisine}
KeywordsPattern=

[dossier_restaurant|filtre=restaurants]
NamePattern={nom} / la selection restaurants Parismange
DescriptionPattern=la selection restaurant Parismange {nom} {code_postal} {type_cuisine}
KeywordsPattern=

[dossier_restaurant|filtre=coup_coeur]
NamePattern={nom} / les coups de coeurs Parismange
DescriptionPattern=les coups de coeurs Parismange {nom} {code_postal} {type_cuisine}
KeywordsPattern=



*
*
*
*
*/

?>