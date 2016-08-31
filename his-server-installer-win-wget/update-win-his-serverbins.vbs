Set oShell = CreateObject("WScript.Shell")
strHomeFolder = oShell.ExpandEnvironmentStrings("%USERPROFILE%")

Dim filesys
Set filesys = CreateObject("Scripting.FileSystemObject") 
Set oShell = CreateObject("WScript.Shell")

'oShell.Run "kill-win-his-server.bat",1,true

' DELETE HIS
If filesys.FolderExists("serverbins-win") Then  
	filesys.DeleteFolder("serverbins-win")
End If

' DOWNLOAD HIS
If Not filesys.FolderExists("serverbins-win") Then
	oShell.Run "wget\wget.exe --no-check-certificate --output-document=serverbins-win.zip https://humanintelligencesystem.com/version?dl=serverbins-win",1,True
	oShell.Run "7zip\7za.exe x -y serverbins-win.zip",1,True
End If





