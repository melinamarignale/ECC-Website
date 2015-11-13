Workflow ezSimpleStockCheck

author: fats@grandmore.com

Copyright (C) 2005 Grandmore. All rights reserved.
http://www.grandmore.com
http://www.grandmore.co.uk

Overview:
This extension enable simple stock control of items to be sold. When creating an item for sale 
simply enter an attribute with an identifier called "quantity".

When items are sold this attribute field is decremented by the quantity ordered.

If you change the "add to basket" button with some template code that tests the quantity field 
you can prevent users from purchasing or tell them they are not in stock.

Setup of Quantity Attribute:
1) Create an attribute for your product with the identifier called "quantity"

2) Set the minimum to '-1' and the maximum to a large number like 999. If the admin enters -2 it 
could mean out of stock. 

(You could add other minus numbers to mean different states like, out of stock, discontinued, etc)


Setup:
1) Install extension. 
2) Activate it with the admin interface
3) Create a workflow and add the ezSimpleStockCheck item.
4) Setup a trigger to be activated AFTER checkout.

5) you may need to activate this extension by adding or modiying a file called "workflow.ini.append.php" 
in the settings/override folder and add the following code to activate it

//-------

[EventSettings]
ExtensionDirectories[]
ExtensionDirectories[]=protx
ExtensionDirectories[]=ezsimplestockcheck

# A list of events, each entry consists of the group
# and the name with a _ as separator
AvailableEventTypes[]=ezsimplestockcheck

//-------

Example template code
Found in doc/example_code.tpl

This code is an example of using the quantity field for informing the customer when an item is out 
of stock etc.

The first block leaves the "addToBasket" button working the next two disable the button. You can have 
an out of stock warning while still allow it to be purchaced it up to you.

