<?php /* #?ini charset="iso-8859-1"?

#?ini charset="iso-8859-1"?
# eZ publish configuration file for workflows.
#

[EventSettings]
# A list of directories to check for workflow eventtypes
RepositoryDirectories[]=kernel/classes/workflowtypes

# A list of extensions which have workflow events
# It's common to create a settings/workflow.ini.append file
# in your extension and add the extension name to automatically
# get workflow events from the extension when it's turned on.
ExtensionDirectories[]
ExtensionDirectories[]=ezsimplestockcheck

# A list of events, each entry consists of the group
# and the name with a _ as separator
AvailableEventTypes[]=event_ezsimplestockcheck



*/ ?>