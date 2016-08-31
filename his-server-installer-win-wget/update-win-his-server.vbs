Set oShell = CreateObject("WScript.Shell")
strHomeFolder = oShell.ExpandEnvironmentStrings("%USERPROFILE%")

Dim filesys
Set filesys = CreateObject("Scripting.FileSystemObject") 
Set oShell = CreateObject("WScript.Shell")

'oShell.Run "kill-win-his-server.bat",1,true

' DELETE HIS
If filesys.FolderExists("his") Then  
	filesys.DeleteFolder("his")
End If

' DOWNLOAD HIS
If Not filesys.FolderExists("his") Then
	oShell.Run "wget\wget.exe --no-check-certificate --output-document=his.zip https://humanintelligencesystem.com/version/?get=current",1,True
	oShell.Run "7zip\7za.exe x -y his.zip",1,True
End If





