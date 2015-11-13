<?php /* #?ini charset="utf-8"?




# Due to a bug in eZ, the base file shouldn't be kept here when using siteaccess settings (Override these)
# You should then copy it in your siteaccess setting folder
#[MetatagSettings]
#Autowash=disabled

#[AttributesMapping]
#
#DefaultName[]
#DefaultName[]=name
#DefaultName[]=short_name
#
#DefaultDescription[]
#DefaultDescription[]=description
#DefaultDescription[]=short_description
#
#DefaultKeywords[]
#DefaultKeywords[]=keywords
#
#MetatagAttributeIdentifier=meta_tag
#
#FillOnPublish=disabled
# Désactive la surcharge de mapping pour une liste de classes
# Permet de faire exception au circuit de surcharge général
#DisableMapping[]
# DisableMapping[]=film

#Retourne uniquement les valeurs contenus dans l'attribut metatag sans mapping
#MetatagOnlyMapping[]
#MetatagOnlyMapping[]=film

#SpecialMapping[]
# SpecialMapping[]=folder
# SpecialMapping[]=film


# [folder]
# NamePattern={description.ok} réalisé par {name}
# DescriptionPattern={name} wow
# KeywordsPattern={salut} wow
# Description[]=name
# Description[]=short_description
# Keywords[]=keywords

# [film]
# KeywordsPattern={acteurs.prenom}, réalisé par {titre}


*/

?>