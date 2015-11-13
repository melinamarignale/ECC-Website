<?php /* #?ini charset="iso-8859-1"?

[HandlerSettings]
# A list of directories to search for shopaccount handlers
Repositories[]=kernel/classes
# A list of extensions which have shop account handlers
# It's common to create a settings/shopaccount.ini.append file
# in your extension and add the extension name to automatically
# get handlers from the extension when it's turned on.
ExtensionRepositories[]

# Settings for how user accounts should be handled in the shop/checkout
# default is to use internal user accounts in the system
# simple is for handling account information without user registration
[AccountSettings]
Handler=ezdefault
# Allows for overriding a handler with another
Alias[]
# Alias[ezdefault]=eztest

# Settings for how order emails should be handled in the shop/checkout
# default is to send confirmation emails to both customer and admin.
[ConfirmOrderSettings]
Handler=ezdefault
# Allows for overriding a handler with another
Alias[]
*/
?>