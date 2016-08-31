Dim filesys
Set filesys = CreateObject("Scripting.FileSystemObject") 
Set oShell = CreateObject("WScript.Shell")

If Not filesys.FolderExists("serverbins-win") Then
	MsgBox "Folder ""serverbins-win"" does not exist."+vbCr+vbCr+"Run ""install-win-his-server.vbs"" before continuing"
	WScript.quit()
End If
If Not filesys.FolderExists("his") Then
	MsgBox "Folder ""his"" does not exist."+vbCr+vbCr+"Run ""install-win-his-server.vbs"" before continuing"
	WScript.quit()
End If
If Not filesys.FileExists("his-config.php") Then
	MsgBox "File ""his-config.php"" does not exist."+vbCr+vbCr+"Run ""install-win-his-server.vbs"" before continuing"
	WScript.quit()
End If
If Not filesys.FileExists("launch_job_cluster.vbs") Then
	MsgBox "File ""launch_job_cluster.vbs"" does not exist."+vbCr+vbCr+"Run ""install-win-his-server.vbs"" before continuing"
	WScript.quit()
End If
If Not filesys.FileExists("auth.xml") Then
	MsgBox "File ""auth.xml"" does not exist."+vbCr+vbCr+"Run ""install-win-his-server.vbs"" before continuing"
	WScript.quit()
End If

name_arg=""
prev=""

Set args = Wscript.Arguments
For Each arg In args
	If prev = "--name" Then
		name_arg = arg
	End If
	prev = arg
Next

If name_arg <> "" Then

	oShell.CurrentDirectory = "his"
	forever = 0
	Do While forever=0
		oShell.Run "..\serverbins-win\php54\php.exe index.php --name="+name_arg,1,true
		WScript.Sleep 1000
	Loop

Else
	MsgBox "run-win-his-server.vbs was called without a value specified for the --name argument."
	WScript.quit()
End If



