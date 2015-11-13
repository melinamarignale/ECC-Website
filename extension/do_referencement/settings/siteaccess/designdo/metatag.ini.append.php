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
SpecialMapping[]=personnalite
#SpecialMapping[]=folder
SpecialMapping[]=bloc

MetatagAttributeIdentifier=meta_tag

FillOnPublish=disabled
# Désactive la surcharge de mapping pour une liste de classes
# Permet de faire exception au circuit de surcharge général
DisableMapping[]
#DisableMapping[]=personnalite
# DisableMapping[]=film

#Retourne uniquement les valeurs contenus dans l'attribut metatag sans mapping
MetatagOnlyMapping[]
MetagOnlyMapping[]=blog
MetagOnlyMapping[]=film
MetagOnlyMapping[]=folder
MetagOnlyMapping[]=interview
MetagOnlyMapping[]=personnalite
MetagOnlyMapping[]=dossier
MetagOnlyMapping[]=video
MetagOnlyMapping[]=actualite
MetagOnlyMapping[]=game
MetagOnlyMapping[]=affiche_decrypte
MetagOnlyMapping[]=dvd
MetagOnlyMapping[]=article

[personnalite]
NamePattern={prenom} {nom} : filmographie & biographie de {prenom} {nom}
DescriptionPattern={prenom} {nom} : Retouver la biographie, galerie photos, les interviews de {prenom} {nom}
KeywordsPattern={prenom} {nom}, acteur/actrice, biographie, filmographie, photo, photos, galerie, galeries, photographie, film, films, cin&eacute;ma, cinema, interview, interview, premiere, magazine

#[folder]
#NamePattern={name}
#DescriptionPattern={short_description}
#KeywordsPattern={keywords}, {SiteMetaKeywords}

[bloc]
NamePattern={titre_tag}
DescriptionPattern={short_description}
KeywordsPattern={keywords_tag}, {SiteMetaKeywords}

*/

?>