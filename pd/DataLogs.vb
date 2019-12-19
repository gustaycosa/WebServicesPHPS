Imports System.Web
Imports System.Web.Services
Imports System.Web.Services.Protocols
Imports System.Data
Imports System.Data.SqlClient
Imports System.Xml
Imports System.IO
' To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line.
' <System.Web.Script.Services.ScriptService()> _
<WebService(Namespace:="http://tempuri.org/")> _
<WebServiceBinding(ConformsTo:=WsiProfiles.BasicProfile1_1)> _
<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Public Class DataLogs
    Inherits System.Web.Services.WebService
    Dim dAdapter As SqlDataAdapter
    Dim dSet As New DataSet
    Dim dt_Clientes As System.Data.DataTable = New DataTable("dtClientes")
    Dim dtUsuarios As System.Data.DataTable = New DataTable("dtUsuarios")
    Public Structure Mensaje
        Dim eId As String
        Dim eDE As String
        Dim ePara As String
        Dim eFecha As String
        Dim eAsunto As String
        Dim eEnviador As String
        Dim eCC As String
        Dim eBCC() As String
        Dim eRecivido As String
        Dim eCuerpo As String
        Dim eReelevancia As Prioridad
        Dim eAdjunto As String
    End Structure
    Enum Prioridad
        Reelevante
        Normal
        Bajo
    End Enum
    <WebMethod()> _
    Public Function LoginPortal(User As String, Pass As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_LOGIN", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sUser", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@sUser").Value = User
        dAdapter.SelectCommand.Parameters("@sUser").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sPass", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@sPass").Value = Pass
        dAdapter.SelectCommand.Parameters("@sPass").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ValidationUser(User As String, Pass As String) As String()
        On Error GoTo DescripcionErr

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String
        Dim R As SqlDataReader
        Dim aData As String()
        ReDim aData(4)

        Sql = " Select U.Id as Id_Usuario,U.usuario,U.PreAlias + ' ' + U.Nombre as nombre,U.Id_Perfil,P.Perfil,Correo as Email,U.Tipo, "
        Sql = Sql & " U.Id_Grupo, G.Grupo, U.id_empresa "
        Sql = Sql & " From NombresUsuarioWeb U "
        Sql = Sql & " left join Perfiles  P on P.Id_Perfil =u.Id_Perfil "
        Sql = Sql & " left join Grupos   G on G.Id_Grupo  =u.Id_Grupo "
        Sql = Sql & " where usuario='" & Trim(User) & "'"
        Sql = Sql & " and contraseña='" & Trim(Pass) & "'"

        R = Nothing

        Dim sqlComm As New SqlCommand(Sql, Globales.SqlConn)
        R = sqlComm.ExecuteReader()
        If R.HasRows Then
            While R.Read()

                aData(0) = R("Id_Usuario")
                aData(1) = R("nombre").ToString()
                aData(2) = R("Email").ToString()
                aData(3) = R("Tipo").ToString()
                aData(4) = R("id_empresa").ToString()

            End While


        Else
            aData(0) = 0
            aData(1) = ""
            aData(2) = ""
            aData(2) = 0
        End If
        R.Close()
        sqlComm.Dispose()
        sqlComm = Nothing

        ValidationUser = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If

        Exit Function

DescripcionErr:
    End Function
    <WebMethod()> _
    Public Function HelloWorld(YourName As String, YourAge As Integer) As String
        Return String.Format("Hello {0}, you are {1} years old.", YourName, YourAge)
    End Function
    <WebMethod()> _
    Public Function MuestraMaquinaria() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String

        '  Crear_dtClientes()

        Sql = "select MA.id_maquinaria, TM.TipoMaquinaria, MR.marca, MD.Modelo from maquinaria MA "
        Sql = Sql & "inner join marcas MR on MA.id_marca = MR.id_marca "
        Sql = Sql & "inner join ModeloMaquinaria  MD on MA.id_modelo = MD.Id_Modelo "
        Sql = Sql & "left join TipoMaquinaria TM on MD.id_tipomaquinaria = TM.Id_TipoMaquinaria "
        Sql = Sql & "where MA.es_propia = 1 And MA.estatus = 1 "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MuestraClientes(ByVal CveBusqueda As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_SELECT_CLIENTES", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@CveBusqueda", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@CveBusqueda").Value = CveBusqueda
        dAdapter.SelectCommand.Parameters("@CveBusqueda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MuestraClientesVend(ByVal CveVendedor As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_SELECT_CLIENTESVEND", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function UsuariosSelect(ByVal sId_Empresa As String, ByVal iId As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_USUARIOS_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iId", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId").Value = iId
        dAdapter.SelectCommand.Parameters("@iId").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function WebMenuCreator(ByVal sUser As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_MENU_CREATOR", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sUser", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sUser").Value = sUser
        dAdapter.SelectCommand.Parameters("@sUser").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iError", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@iError").Direction = ParameterDirection.Output

        dAdapter.SelectCommand.Parameters.Add("@msg", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MAquinariaPSelect() As DataSet
        'Public Function MAquinariaPSelect(ByVal iId_Maquinaria As Integer, ByVal iMarca As Integer, ByVal iModelo As Integer, ByVal iTipo As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_MAQUINARIAPROPIA_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        'dAdapter.SelectCommand.Parameters.Add("@iId_Maquinaria", SqlDbType.Int)
        'dAdapter.SelectCommand.Parameters("@iId_Maquinaria").Value = iId_Maquinaria
        'dAdapter.SelectCommand.Parameters("@iId_Maquinaria").Direction = ParameterDirection.Input

        'dAdapter.SelectCommand.Parameters.Add("@iMarca", SqlDbType.Int)
        'dAdapter.SelectCommand.Parameters("@iMarca").Value = iMarca
        'dAdapter.SelectCommand.Parameters("@iMarca").Direction = ParameterDirection.Input

        'dAdapter.SelectCommand.Parameters.Add("@iModelo", SqlDbType.Int)
        'dAdapter.SelectCommand.Parameters("@iModelo").Value = iModelo
        'dAdapter.SelectCommand.Parameters("@iModelo").Direction = ParameterDirection.Input

        'dAdapter.SelectCommand.Parameters.Add("@iTipo", SqlDbType.Int)
        'dAdapter.SelectCommand.Parameters("@iTipo").Value = iTipo
        'dAdapter.SelectCommand.Parameters("@iTipo").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function AcondicionamientoSelect(ByVal iId_maquina As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_ACOND_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@iId_maquina", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId_maquina").Value = iId_maquina
        dAdapter.SelectCommand.Parameters("@iId_maquina").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasxVendedorGral(ByVal sId_Empresa As String, ByVal sId_Vendedor As String, ByVal dFechaIni As DateTime, ByVal dFechaFin As DateTime) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_VTAS_VentasporVendedorGral", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sId_Vendedor", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Vendedor").Value = sId_Vendedor
        dAdapter.SelectCommand.Parameters("@sId_Vendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaIni").Value = dFechaIni
        dAdapter.SelectCommand.Parameters("@dFechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaFin").Value = dFechaFin
        dAdapter.SelectCommand.Parameters("@dFechaFin").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function AltaFolioChecklist(ByVal sId_Empresa As String, ByVal sId_Empleado As String, ByVal sSerie As String, ByVal iRango1 As Integer, ByVal iRango2 As Integer, ByVal sUsuario As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo err

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_AltaFoliosChk", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sId_Empleado", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@sId_Empleado").Value = sId_Empleado
        dAdapter.SelectCommand.Parameters("@sId_Empleado").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sSerie", SqlDbType.NVarChar, 1)
        dAdapter.SelectCommand.Parameters("@sSerie").Value = sSerie
        dAdapter.SelectCommand.Parameters("@sSerie").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iRango1", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iRango1").Value = iRango1
        dAdapter.SelectCommand.Parameters("@iRango1").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iRango2", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iRango2").Value = iRango2
        dAdapter.SelectCommand.Parameters("@iRango2").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sUsuario", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sUsuario").Value = sUsuario
        dAdapter.SelectCommand.Parameters("@sUsuario").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iError", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@iError").Direction = ParameterDirection.Output

        dAdapter.SelectCommand.Parameters.Add("@msg", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CmbEmpleadosSelect() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String

        Sql = " select USERID, NAME from ATT_USERINFO WHERE ATT_Status = 1 order by NAME "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CmbCualquiera(ByVal sID As String, ByVal sNombre As String, ByVal sTabla As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_GRAL_CBO_CUALQUIERA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sID", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@sID").Value = sID
        dAdapter.SelectCommand.Parameters("@sID").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sNombre", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@sNombre").Value = sNombre
        dAdapter.SelectCommand.Parameters("@sNombre").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sTabla", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@sTabla").Value = sTabla
        dAdapter.SelectCommand.Parameters("@sTabla").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CmbCualquieraVtas(ByVal sPuesto As String, ByVal sDepto As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_GRAL_CBO_EMPLEADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sPuesto", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@sPuesto").Value = sPuesto
        dAdapter.SelectCommand.Parameters("@sPuesto").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sDepto", SqlDbType.NVarChar, 50)
        dAdapter.SelectCommand.Parameters("@sDepto").Value = sDepto
        dAdapter.SelectCommand.Parameters("@sDepto").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function CmbCualquieraWhere(ByVal sID As String, ByVal sNombre As String, ByVal sTabla As String, ByVal sWhere As String, ByVal sWhereID As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String

        Sql = " select " & sID & ", " & sNombre & " from " & sTabla & " where " & sWhere & "=" & sWhereID & " order by " & sNombre

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CBO_ALM_FAMILIAS(ByVal sWhere1 As String, ByVal sWhere2 As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_ALM_CBO_FAMILIA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sWhere1", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sWhere1").Value = sWhere1
        dAdapter.SelectCommand.Parameters("@sWhere1").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sWhere2", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sWhere2").Value = sWhere2
        dAdapter.SelectCommand.Parameters("@sWhere2").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CBO_ALM_MODELO(ByVal sWhere1 As String, ByVal sWhere2 As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_ALM_CBO_MODELO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sWhere1", SqlDbType.NVarChar, 30)
        dAdapter.SelectCommand.Parameters("@sWhere1").Value = sWhere1
        dAdapter.SelectCommand.Parameters("@sWhere1").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sWhere2", SqlDbType.NVarChar, 30)
        dAdapter.SelectCommand.Parameters("@sWhere2").Value = sWhere2
        dAdapter.SelectCommand.Parameters("@sWhere2").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CBO_GENERICO_ANT(ByVal sClave As String, ByVal sWhere As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CBO_GENERICO_ANT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Cve_Opt", SqlDbType.NVarChar, 30)
        dAdapter.SelectCommand.Parameters("@Cve_Opt").Value = sClave
        dAdapter.SelectCommand.Parameters("@Cve_Opt").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sWhere", SqlDbType.NVarChar, 500)
        dAdapter.SelectCommand.Parameters("@sWhere").Value = sWhere
        dAdapter.SelectCommand.Parameters("@sWhere").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ExistenciasSelect(ByVal sId_Empresa As String, ByVal sDivision As String, ByVal sDepto As String, ByVal sFamilia As String, ByVal sText As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_ALM_Existencias", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sDivision", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sDivision").Value = sDivision
        dAdapter.SelectCommand.Parameters("@sDivision").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sDepto", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sDepto").Value = sDepto
        dAdapter.SelectCommand.Parameters("@sDepto").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sFamilia", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sFamilia").Value = sFamilia
        dAdapter.SelectCommand.Parameters("@sFamilia").Direction = ParameterDirection.Input


        dAdapter.SelectCommand.Parameters.Add("@sText", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@sText").Value = sText
        dAdapter.SelectCommand.Parameters("@sText").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function UsuariosInsert(sUsuario As String, sContrasena As String, sNombre As String, sTelefono As String, sId_Empresa As String, iId_Grupo As Integer, iId_Perfil As Integer, sCorreo As String, sPassCorreo As String) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)


        Cm = New SqlCommand("Web.php_SP_CTRL_USUARIOS_ABC", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure


        Cm.Parameters.Add("@iOpc", SqlDbType.Int)
        Cm.Parameters("@iOpc").Value = 1
        Cm.Parameters("@iOpc").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = 0
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        Cm.Parameters("@sId_Empresa").Value = sId_Empresa
        Cm.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sUsuario", SqlDbType.NVarChar, 15)
        Cm.Parameters("@sUsuario").Value = sUsuario
        Cm.Parameters("@sUsuario").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sContrasena", SqlDbType.NVarChar, 15)
        Cm.Parameters("@sContrasena").Value = sContrasena
        Cm.Parameters("@sContrasena").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sNombre", SqlDbType.NVarChar, 250)
        Cm.Parameters("@sNombre").Value = sNombre
        Cm.Parameters("@sNombre").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sTelefono", SqlDbType.NVarChar, 25)
        Cm.Parameters("@sTelefono").Value = sTelefono
        Cm.Parameters("@sTelefono").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId_Grupo", SqlDbType.Int)
        Cm.Parameters("@iId_Grupo").Value = iId_Grupo
        Cm.Parameters("@iId_Grupo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId_Perfil", SqlDbType.Int)
        Cm.Parameters("@iId_Perfil").Value = iId_Perfil
        Cm.Parameters("@iId_Perfil").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sCorreo", SqlDbType.NVarChar, 50)
        Cm.Parameters("@sCorreo").Value = sCorreo
        Cm.Parameters("@sCorreo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sPassCorreo", SqlDbType.NVarChar, 20)
        Cm.Parameters("@sPassCorreo").Value = sPassCorreo
        Cm.Parameters("@sPassCorreo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 300)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        UsuariosInsert = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function UsuariosUpdate(iId As Integer, sUsuario As String, sContrasena As String, sNombre As String, sTelefono As String, sId_Empresa As String, iId_Grupo As Integer, iId_Perfil As Integer, sCorreo As String, sPassCorreo As String) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)


        Cm = New SqlCommand("Web.php_SP_CTRL_USUARIOS_ABC", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure


        Cm.Parameters.Add("@iOpc", SqlDbType.Int)
        Cm.Parameters("@iOpc").Value = 2
        Cm.Parameters("@iOpc").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = iId
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        Cm.Parameters("@sId_Empresa").Value = ""
        Cm.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sUsuario", SqlDbType.NVarChar, 15)
        Cm.Parameters("@sUsuario").Value = ""
        Cm.Parameters("@sUsuario").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sContraseña", SqlDbType.NVarChar, 15)
        Cm.Parameters("@sContraseña").Value = sContrasena
        Cm.Parameters("@sContraseña").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sNombre", SqlDbType.NVarChar, 250)
        Cm.Parameters("@sNombre").Value = sNombre
        Cm.Parameters("@sNombre").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sTelefono", SqlDbType.NVarChar, 10)
        Cm.Parameters("@sTelefono").Value = sTelefono
        Cm.Parameters("@sTelefono").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId_Grupo", SqlDbType.Int)
        Cm.Parameters("@iId_Grupo").Value = iId_Grupo
        Cm.Parameters("@iId_Grupo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId_Perfil", SqlDbType.Int)
        Cm.Parameters("@iId_Perfil").Value = iId_Perfil
        Cm.Parameters("@iId_Perfil").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sCorreo", SqlDbType.NVarChar, 50)
        Cm.Parameters("@sCorreo").Value = sCorreo
        Cm.Parameters("@sCorreo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sPassCorreo", SqlDbType.NVarChar, 20)
        Cm.Parameters("@sPassCorreo").Value = sPassCorreo
        Cm.Parameters("@sPassCorreo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 250)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        UsuariosUpdate = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function UsuariosDelete(ByVal iId As Integer) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)


        Cm = New SqlCommand("Web.php_SP_CTRL_USUARIOS_DELETE", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = iId
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 250)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        UsuariosDelete = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaxClientes() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String


        Sql = " Select C.Id_Cliente,C.nombre As NomCliente ,C.Rfc,C.Telefono, "
        Sql = Sql & " (Select Count(Id_Maquinaria) From Maquinaria M Where M.Id_cliente =C.id_cliente And Clasificacion=1  ) As NumMaqNva, "
        Sql = Sql & " (Select Count(Id_Maquinaria) From Maquinaria M Where M.Id_cliente =C.id_cliente And Clasificacion=2  ) As NumMaqUda "
        Sql = Sql & " From Clientes C "
        Sql = Sql & " Where C.id_cliente In (Select Distinct(id_cliente) From Maquinaria Where Estatus =1)"
        Sql = Sql & "Order By C.Id_cliente "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaNueva(ByVal sId_Cliente As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String

        Sql = " Select M.Id_Maquinaria,    "
        Sql = Sql & " M2.Id_Marca,M2.Marca,T.Id_TipoMaquinaria,T.TipoMaquinaria,M3.Id_Modelo ,M3.Modelo ,"
        Sql = Sql & " M.Serie,Coalesce(M.seriemotor,'') as SerieMotor,Coalesce(M.SerieTransmision,'') as SerieTransmision,"
        Sql = Sql & " (select count(movimiento) From RecepcionMaquinaria R Where R.Id_Maquinaria =M.Id_Maquinaria and r.Estatus ='Terminado') as ServiciosFinalizados,"
        Sql = Sql & " (select count(movimiento) From RecepcionMaquinaria R Where R.Id_Maquinaria =M.Id_Maquinaria and r.Estatus ='Servicio') as ServiciosProceso,"
        Sql = Sql & " coalesce((select top 1  HorasServicio  From RecepcionMaquinaria R Where R.Id_Maquinaria =M.Id_Maquinaria and r.Estatus <>'Cancelado' order by folio desc),0) as HorasUltServicio,"
        Sql = Sql & " CONVERT(INT,coalesce((select sum(existencia)  From existencias E where E.articulo=M.Articulo),0)) as Existencia"
        Sql = Sql & " From "
        Sql = Sql & " Maquinaria M"
        Sql = Sql & " inner join Clientes C on M.id_cliente=C.Id_cliente                                                 "
        Sql = Sql & " inner join Marcas M2 on M.id_marca=M2.Id_marca                                                     "
        Sql = Sql & " inner join ModeloMaquinaria  M3 on M.Id_Modelo = M3.Id_modelo                                      "
        Sql = Sql & " inner join TipoMaquinaria T on T.Id_TipoMaquinaria = M3.Id_TipoMaquinaria                          "
        Sql = Sql & " Where m.Estatus = 1 And m.Clasificacion =1"
        Sql = Sql & " AND  C.ID_CLIENTE ='" & Trim(sId_Cliente) & "' "
        Sql = Sql & "Order By M.Id_cliente ,M.Id_Marca,M.Id_Modelo ,M.Id_Maquinaria,M.Serie "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaUsada(ByVal sId_Cliente As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String

        Sql = " Select M.Id_Maquinaria,    "
        Sql = Sql & " M2.Id_Marca,M2.Marca,T.Id_TipoMaquinaria,T.TipoMaquinaria,M3.Id_Modelo ,M3.Modelo ,"
        Sql = Sql & " M.Serie,Coalesce(M.seriemotor,'') as SerieMotor,Coalesce(M.SerieTransmision,'') as SerieTransmision,"
        Sql = Sql & " (select count(movimiento) From RecepcionMaquinaria R Where R.Id_Maquinaria =M.Id_Maquinaria and r.Estatus ='Terminado') as ServiciosFinalizados,"
        Sql = Sql & " (select count(movimiento) From RecepcionMaquinaria R Where R.Id_Maquinaria =M.Id_Maquinaria and r.Estatus ='Servicio') as ServiciosProceso,"
        Sql = Sql & " coalesce((select top 1  HorasServicio  From RecepcionMaquinaria R Where R.Id_Maquinaria =M.Id_Maquinaria and r.Estatus <>'Cancelado' order by folio desc),0) as HorasUltServicio"
        Sql = Sql & " From "
        Sql = Sql & " Maquinaria M"
        Sql = Sql & " inner join Clientes C on M.id_cliente=C.Id_cliente                                                 "
        Sql = Sql & " inner join Marcas M2 on M.id_marca=M2.Id_marca                                                     "
        Sql = Sql & " inner join ModeloMaquinaria  M3 on M.Id_Modelo = M3.Id_modelo                                      "
        Sql = Sql & " inner join TipoMaquinaria T on T.Id_TipoMaquinaria = M3.Id_TipoMaquinaria                          "
        Sql = Sql & " Where m.Estatus = 1 And m.Clasificacion =2"
        Sql = Sql & " AND  C.ID_CLIENTE ='" & Trim(sId_Cliente) & "' "
        Sql = Sql & "Order By M.Id_cliente ,M.Id_Marca,M.Id_Modelo ,M.Id_Maquinaria,M.Serie "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ServiciosTaller(iId_Maquinaria As String, sEstatus As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim Sql As String

        Sql = "   Select COALESCE((SELECT FOLIOCASO FROM CrmCasos WHERE ServicioTaller = R.MOVIMIENTO),0) AS Caso, "
        Sql = Sql & " replace(convert(NVARCHAR, R.FechaRecepcion, 106), ' ', '/') AS FechaRecepcion,R.Estatus,R.Concepto,R.Folio,R.Movimiento, ST.id_sucursal as Taller,SP.id_sucursal as Bodega ,"
        Sql = Sql & " U.nombre as Recibio, "
        Sql = Sql & " (Select NOMBRE + ' ' + APP     from ACTFEMPLEADOS WHERE ID_EMPLEADO =R.Id_Empleado  ) AS Mecanico,"
        Sql = Sql & " (Select count(Articulos) From Pedidostaller  where movimiento =R.Movimiento  and Estatus ='ACTUALIZAD') AS Articulos,"
        Sql = Sql & " (Select count(pedido) From Pedidostaller  where movimiento =R.Movimiento  and Estatus ='ACTUALIZAD') AS Pedidos_Act,"
        Sql = Sql & " (Select count(pedido) From Pedidostaller  where movimiento =R.Movimiento  and Estatus ='CAPTURA') AS Pedidos_Cap,"
        Sql = Sql & " (Select count(pedido) From Pedidostaller  where movimiento =R.Movimiento  and Estatus ='CAPTURA') AS Pedidos_Can,"
        Sql = Sql & " (Select CONVERT(NVARCHAR(30), CONVERT(MONEY, SUM(TotalCosto)), 1) From Pedidostaller  where movimiento =R.Movimiento  and Estatus ='ACTUALIZAD') AS Total_Costo"
        Sql = Sql & " From RecepcionMaquinaria R "
        Sql = Sql & " inner join NombresUsuarioWeb U on r.id_usuario_Recibio=u.id "
        Sql = Sql & " inner join Maquinaria M on M.Id_Maquinaria = R.Id_Maquinaria "
        Sql = Sql & " inner join Clientes C on M.id_cliente=C.Id_cliente  "
        Sql = Sql & " inner join Marcas M2 on M.id_marca=M2.Id_marca "
        Sql = Sql & " inner join ModeloMaquinaria  M3 on M.Id_Modelo =M3.Id_modelo"
        Sql = Sql & " inner join TipoMaquinaria T on T.Id_TipoMaquinaria = M3.Id_TipoMaquinaria"
        Sql = Sql & " inner join Control.dbo.Empresas  E on E.Id = R.Id_Empresa "
        Sql = Sql & " inner join Sucursales  ST on ST.Id  = R.Id_sucursal_Taller and  ST.Id_Empresa = E.Id_Empresa"
        Sql = Sql & " inner join Sucursales  SP on SP.Id = R.Id_sucursal_Proveedor and  SP.Id_Empresa = E.Id_Empresa"
        Sql = Sql & " Where M.ID_MAQUINARIA =" & iId_Maquinaria
        Sql = Sql & " and R.Estatus = '" & Trim(sEstatus) & "'"
        Sql = Sql & " Order By R.folio,R.FechaRecepcion"

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function PedidosTaller(sMovimiento As String, sEstatus As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String

        Sql = "    Select Pedido , Tipo AS TipoPedido, Estatus ,replace(convert(NVARCHAR, Fecha, 106), ' ', '/') AS FechaPedido,Articulos,Cantidad,CONVERT(NVARCHAR(30), CONVERT(MONEY, TotalCosto), 1) as TotalCosto,CONVERT(NVARCHAR(30), CONVERT(MONEY, TotalPrecioVenta), 1) as TotalPrecioVenta"
        Sql = Sql & " From Pedidostaller "
        Sql = Sql & " where movimiento ='" & sMovimiento.Trim & "'"
        Sql = Sql & " and estatus='" & sEstatus.Trim & "'"
        Sql = Sql & " Order By Pedido Desc   "
        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function DetallePedidosTaller(ByVal sMovimiento As String, ByVal sPedido As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String

        Sql = ""
        Sql = Sql & "  Select Pd.Renglon,Pd.Factura,Pd.Cotizacion, Pd.Articulo,Pd.Descripcion,Pd.Estatus,"
        Sql = Sql & " Pd.Costo, Pd.PrecioVenta, Pd.ImporteCosto, Pd.ImportePrecioVenta,"
        Sql = Sql & " Pd.Iva, Pd.ImpIvacosto, Pd.ImpIvaPrecioVenta, Pd.Pedida, Pd.Recibida, Pd.Pendiente, Pd.Devuelta,"
        Sql = Sql & " Pd.SubtotalCosto, Pd.SubtotalPrecioVenta "
        Sql = Sql & " From PedidosTallerDet PD inner join PedidosTaller P on P.Pedido=PD.Pedido "
        Sql = Sql & " Where P.Movimiento = '" & Trim(sMovimiento) & "'"
        Sql = Sql & " and Pd.Pedido= '" & Trim(sPedido) & "'"
        Sql = Sql & " Order By Pd.Renglon Asc   "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ReporteAsistencias(ByVal sId_Empresa As String, ByVal De As DateTime, ByVal A As DateTime, ByVal iUserID As Integer) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String

        Sql = " EXEC ATT_ReporteAsistencias '" & Format(De.Day, "00") & "/" & Format(De.Month, "00") & "/" & De.Year & "','" & Format(A.Day, "00") & "/" & Format(A.Month, "00") & "/" & A.Year & "', " & iUserID
        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function AutX(p1 As String, p2 As String, p3 As String) As String()
        Dim aData As String()
        ReDim aData(2)
        Dim EmailSolicitante As String


        If Len(Trim(p2)) <= 0 Then
            aData(0) = " >>>> Id=" & p1 & "Respuesta=" & p3 & "Movimiento=" & p2
            aData(1) = 1
            GoTo xSig
        End If

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        Dim Cm As SqlCommand = Nothing
        'On Error GoTo ErrSpMovtosTallerInsert
        Cm = New SqlCommand("SP_AutorizaCliHistorialAutorizaciones", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure


        Cm.Parameters.Add("@Id_Autorizacion", SqlDbType.Int)
        Cm.Parameters("@Id_Autorizacion").Value = p1
        Cm.Parameters("@Id_Autorizacion").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Respuesta", SqlDbType.NVarChar, 15)
        Cm.Parameters("@Respuesta").Value = p3
        Cm.Parameters("@Respuesta").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Mov", SqlDbType.NVarChar, 30)
        Cm.Parameters("@Mov").Value = p2
        Cm.Parameters("@Mov").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@EmailSolicita", SqlDbType.NVarChar, 50)
        Cm.Parameters("@EmailSolicita").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 250)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output



        Cm.ExecuteNonQuery()


        aData(0) = Cm.Parameters("@msg").Value
        EmailSolicitante = Cm.Parameters("@EmailSolicita").Value

        If Cm.Parameters("@iError").Value <> 0 Then
            GoTo xSig
        End If

        Cm = Nothing


        Dim Asunto As String        'Variable Para Almacenar El Titulo del Correo que se Enviara ala Persona Que Solicito el Saldo

        Asunto = "Id Autorizacion  : " & p1 & ", Movimiento = " & p2

        Dim Cuerpo As String        'Variable Para Almacenar El Titulo del Correo que se Enviara ala Persona Que Solicito el Saldo

        Cuerpo = "<body>"
        Cuerpo = "<b>Accion Ejecutada Correctamente<b><br>"
        Cuerpo = Cuerpo & "<b><i><s>Id Autorizacion = " & p1 & ", Movimiento = " & p2 & "</s></i></b><br>"
        Cuerpo = Cuerpo & "<b>Tecnologia Agricola y Construccion SA DE CV<b><br>"
        Cuerpo = Cuerpo & "<b>...........................<b><body>"
        Cuerpo = Cuerpo & "</body>"

        Dim y As New Mensaje

        With y
            .eAsunto = Asunto
            .eCuerpo = Cuerpo
            .eReelevancia = Prioridad.Reelevante
            .eDE = "dwh@taycosa.mx"
            .ePara = EmailSolicitante
        End With

        If UCase(p3) = "SI" Then
            aData(0) = "Autorizacion Correcta"
            aData(1) = 1

        Else
            aData(0) = "La Solicitud Fue Rechazada"
            aData(1) = 2
        End If


        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If

xSig:


        AutX = aData

        Return AutX

    End Function
    <WebMethod()> _
    Public Function AutOrden(Id As String, Orden As String, Respuesta As String) As String()
        Dim aData As String()
        ReDim aData(2)

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If



        Dim Cm As SqlCommand = Nothing
        'On Error GoTo ErrSpMovtosTallerInsert
        Cm = New SqlCommand("SP_AutorizaOrdenCompra", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure


        Cm.Parameters.Add("@Id_Autorizacion", SqlDbType.NVarChar, 25)
        Cm.Parameters("@Id_Autorizacion").Value = Id
        Cm.Parameters("@Id_Autorizacion").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Orden", SqlDbType.NVarChar, 25)
        Cm.Parameters("@Orden").Value = Orden
        Cm.Parameters("@Orden").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Respuesta", SqlDbType.NVarChar, 150)
        Cm.Parameters("@Respuesta").Value = Respuesta
        Cm.Parameters("@Respuesta").Direction = ParameterDirection.Input


        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 250)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output



        Cm.ExecuteNonQuery()




        If Cm.Parameters("@iError").Value <> 0 Then
            aData(0) = "Solicitud Rechazada " & Cm.Parameters("@msg").Value
            aData(1) = 2
            GoTo xSig
        Else
            aData(0) = "Autorizacion Correcta"
            aData(1) = 1
        End If

        Cm = Nothing



        Dim Asunto As String        'Variable Para Almacenar El Titulo del Correo que se Enviara ala Persona Que Solicito el Saldo

        Dim Cuerpo As String        'Variable Para Almacenar El Titulo del Correo que se Enviara ala Persona Que Solicito el Saldo
        Dim y As New Mensaje





        '------------Cambia Estatus Aumento 




        Asunto = "Autorizacion Codigo : " & Id & ", Orden = " & Orden

        Cuerpo = "<body>"
        Cuerpo = "<b>Solicitud Autorizada Correctamente<b><br>"
        Cuerpo = Cuerpo & "<b><i><s>Codigo DWH = " & Id & ", Orden de Compra = " & Orden & "</s></i></b><br>"
        Cuerpo = Cuerpo & "<b>Data Ware House TAYCO SA DE CV<b><br>"
        Cuerpo = Cuerpo & "<b>...........................<b><body>"
        Cuerpo = Cuerpo & "</body>"



        Dim Solicitante As String
        Dim Correo As String

        Solicitante = DameSolicitante(Id)
        Correo = DameCorreo(Solicitante)

        With y
            .eAsunto = Asunto
            .eCuerpo = Cuerpo
            .eReelevancia = Prioridad.Reelevante
            .eDE = "dwh@taycosa.mx"
            .ePara = Correo
        End With

xSig:


        AutOrden = aData

        Return AutOrden

    End Function
    <WebMethod()> _
    Public Function MaquinariaParaVta() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_MaquinariaParaVta", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaParaReparacion() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_MaquinariaParaReparacion", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaParaTerminar() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_MaquinariaParaTerminar", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaParaCatalogo() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_MaquinariaParaCatalogo", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function MaquinariaParaVtaDetalle(Id_Maq As Integer) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_MaquinariaParaVtaDetalle", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Maquinaria", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@Id_Maquinaria").Value = Id_Maq
        dAdapter.SelectCommand.Parameters("@Id_Maquinaria").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If

    End Function
    <WebMethod()> _
    Public Function CargaEmpleados(Todos As Boolean, ByVal sDepto As String, ByVal sPuesto As String) As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String
        Dim SqlWhere As String
        SqlWhere = ""


        Sql = ""
        Sql = Sql & " "
        Sql = Sql & " SELECT E.Id_Empleado,E.NOMBRE "
        Sql = Sql & " FROM NomEmpleados E"
        Sql = Sql & " INNER JOIN NomDepartamentos D ON E.CVE_DEPTO =D.cve_depto  "
        Sql = Sql & " INNER JOIN NomPuestos P ON E.Id_Puesto  =P.Id_Puesto "
        Sql = Sql & " WHERE E.ESTATUS='ACTIVO'"

        If sDepto.Trim.Length > 0 Then
            SqlWhere = SqlWhere & " AND D.Descripcion='" & sDepto.Trim & "'"
        End If
        If sPuesto.Trim.Length > 0 Then
            SqlWhere = SqlWhere & " and  P.puesto ='" & sPuesto.Trim & "'"
        End If

        Sql = Sql & SqlWhere & " Order By E.ID_EMPLEADO "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If


    End Function
    <WebMethod()> _
    Public Function CargaMecanicos() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String
        Dim SqlWhere As String
        SqlWhere = ""


        Sql = ""
        Sql = Sql & " "
        Sql = Sql & " SELECT E.Cve_Empleado,E.NOMBRE "
        Sql = Sql & " FROM NomEmpleados E"
        Sql = Sql & " INNER JOIN NomDepartamentos D ON E.CVE_DEPTO =D.cve_depto  "
        Sql = Sql & " INNER JOIN NomPuestos P ON E.Id_Puesto  =P.Id_Puesto "
        Sql = Sql & " WHERE E.ESTATUS='ACTIVO'"
        Sql = Sql & " AND D.Descripcion LIKE '%TALLER%'"
        Sql = Sql & Sql & " Order By E.Cve_Empleado "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If


    End Function
    <WebMethod()> _
    Public Function CargaVendedores() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String
        Dim SqlWhere As String
        SqlWhere = ""


        Sql = ""
        Sql = Sql & " "
        Sql = Sql & " SELECT Id_Vendedor,NOMBRE "
        Sql = Sql & " FROM Vendedores V"
        Sql = Sql & " WHERE ESTATUS='Operando'"

        Sql = Sql & SqlWhere & " Order By Id_Vendedor"

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If


    End Function
    Public Function DameCorreo(ByVal IdUsuario As String) As String
        On Error GoTo err
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim sql As String
        sql = ""
        sql = sql & " Select Correo From NombresUsuarioWeb"
        sql = sql & " Where Id = '" & IdUsuario & "'"
        Dim cmd As SqlCommand = New SqlCommand(sql, Globales.SqlConn)
        DameCorreo = cmd.ExecuteScalar
        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
        Exit Function
err:
        DameCorreo = "luis.fabela@taycosa.mx"
    End Function
    Public Function DameSolicitante(ByVal IdSolicitud As String) As String
        On Error GoTo err
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        Dim sql As String
        sql = ""
        sql = sql & " Select idSolicita "
        sql = sql & " From TareasAumentosLimites "
        sql = sql & " Where IdAumento = '" & IdSolicitud & "'"
        Dim cmd As SqlCommand = New SqlCommand(sql, Globales.SqlConn)
        DameSolicitante = cmd.ExecuteScalar
        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
        Exit Function
err:
        DameSolicitante = "2"
    End Function
    Private Function DameEstatus(ByVal idAumento As String) As String
        Dim Sql As String
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If
        On Error GoTo err
        Sql = ""
        Sql = Sql & " Select Estatus "
        Sql = Sql & " From TareasAumentosLimites "
        Sql = Sql & " Where idAumento='" & idAumento & "'"
        Dim cmd As SqlCommand = New SqlCommand(Sql, Globales.SqlConn)
        DameEstatus = cmd.ExecuteScalar
        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
        Exit Function
err:
        DameEstatus = "INCORRECTO"
    End Function
    <WebMethod()> _
    Public Function ComisionesVendedor(ByVal Id_Empresa As String, ByVal Clave As String, ByVal FechaIni As String, ByVal FechaFin As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_VTAS_COMISIONES_VENDEDOR", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaIni", SqlDbType.Date)
        dAdapter.SelectCommand.Parameters("@FechaIni").Value = FechaIni
        dAdapter.SelectCommand.Parameters("@FechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaFin", SqlDbType.Date)
        dAdapter.SelectCommand.Parameters("@FechaFin").Value = FechaFin
        dAdapter.SelectCommand.Parameters("@FechaFin").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Clave", SqlDbType.NVarChar, 5)
        dAdapter.SelectCommand.Parameters("@Clave").Value = Clave
        dAdapter.SelectCommand.Parameters("@Clave").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ComisionesVendedorSum(ByVal Id_Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_VTAS_COMISIONES_VENTAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ComisionVendedores(ByVal Id_Empresa As String, ByVal FechaIni As String, ByVal FechaFin As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_VTAS_COMISIONES_VENTAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaIni", SqlDbType.Date)
        dAdapter.SelectCommand.Parameters("@FechaIni").Value = FechaIni
        dAdapter.SelectCommand.Parameters("@FechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaFin", SqlDbType.Date)
        dAdapter.SelectCommand.Parameters("@FechaFin").Value = FechaFin
        dAdapter.SelectCommand.Parameters("@FechaFin").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Rpt_Maquinaria_Servicio(ByVal iId_Empresa As Integer) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("SP_Maquinaria_Servicio", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@iId_Empresa", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId_Empresa").Value = iId_Empresa
        dAdapter.SelectCommand.Parameters("@iId_Empresa").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CLI_FactDiaria(ByVal sId_Empresa As String, ByVal sId_Sucursal As String, ByVal dtFechaIni As DateTime, ByVal dtFechaFin As DateTime, ByVal sId_Cliente As String, ByVal sMoneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CLI_FACT_DIARIA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Id_Sucursal", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Sucursal").Value = sId_Sucursal
        dAdapter.SelectCommand.Parameters("@Id_Sucursal").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@FechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@FechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@FechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@FechaFin").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Id_Cliente", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Cliente").Value = sId_Cliente
        dAdapter.SelectCommand.Parameters("@Id_Cliente").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = sMoneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function Edoresultados(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function VtasNetas(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN1", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function VentasNetasDetalle(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralNew", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VentasNetasDetalle2(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralNew2", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasDet(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN2", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function AccesosMenu(ByVal sPerfil As String, ByVal sModulo As String, ByVal sTipoPerfil As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.GOB_SP_Menu_Accesos", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sPerfil", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@sPerfil").Value = sPerfil
        dAdapter.SelectCommand.Parameters("@sPerfil").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sModulo", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@sModulo").Value = sModulo
        dAdapter.SelectCommand.Parameters("@sModulo").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sTipoPerfil", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@sTipoPerfil").Value = sTipoPerfil
        dAdapter.SelectCommand.Parameters("@sTipoPerfil").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasREF(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_REFACTURACION", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasREM(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_GARANTIAREEM", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasNRE(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_GARANTIANORE", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasDRF(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_DEVOREFACTURACION", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasCob(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_COBRADO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasAbo(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_ABONOMES", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasDev(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_DEVOPRODUCTO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasFac(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_FACTURADO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function VtasNetasDes(ByVal Id_Empresa As String, ByVal Ejercicio As String, ByVal Mes As String, ByVal CveVendedor As String, ByVal Moneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.VTAS_SP_GeneralN3_DESCUENTOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = Id_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@CveVendedor", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@CveVendedor").Value = CveVendedor
        dAdapter.SelectCommand.Parameters("@CveVendedor").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = Moneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Accesos(ByVal sPerfil As String, ByVal sModulo As String, ByVal sTipoPerfil As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.GOB_SP_Menu_Accesos", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sPerfil", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sPerfil").Value = sPerfil
        dAdapter.SelectCommand.Parameters("@sPerfil").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sModulo", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@sModulo").Value = sModulo
        dAdapter.SelectCommand.Parameters("@sModulo").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sTipoPerfil", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@sTipoPerfil").Value = sTipoPerfil
        dAdapter.SelectCommand.Parameters("@sTipoPerfil").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function edocumulado(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoresultados_del(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoresultados_dgo(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoventas(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_VENTAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoingresosporservicios(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_INGRESOSSERVICIOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edogastostaller(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_GASTOS_TALLER", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoimplementoemptaller(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_INGEMPTALLER", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edogatosventas(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_GASTOS_VENTAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edomplementoempventas(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_INGEMPVENTAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edofletes(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_FLETES", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edogastosadmon(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_GASTOS_ADMON", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edonomina(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edobalancegeneral(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_BALANCE", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function edobalancegeneral2(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_BALANCE_2", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function edorelacionaclientes(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_ANA_CTES", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edorelaciondeudores(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_ANA_DEUD", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edorelacionalmacen(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_ANA_ALM", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edorelacionproveedores(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_ANA_PRO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edorelacionacreedores(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_ANA_ACR", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edorelacionanticipos(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_ANA_ANTC", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoflujoefectivo(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_FLUJO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoiincentivosjcb(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edorelacionconsignacion(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.SP_EDORESULTADOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function edoperdidacambiaria(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_PERDIDACAMBIARIA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function edogananciacambiaria(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_GANANCIACAMBIARIA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function tallermecanicoshoras(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_HORAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function tallermecanicoshorasdet(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_HORAS_DET", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function tallermecanicoshoras_aprdemo(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_APRDEMO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function tallermecanicoshoras_apser(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_APSER", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function tallermecanicoshoras_capacit(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_CAPACITACION", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function tallermecanicoshoras_mtto(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_MTTO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function


    <WebMethod()> _
    Public Function tallermecanicoshoras_permisos(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_PERMISOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function tallermecanicoshoras_servicio(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_SERVICIO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function tallermecanicoshoras_traslado(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal Empleado As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.php_SP_TALLER_MECANICOS_BIT_TRASLADO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Empleado", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Empleado").Value = Empleado
        dAdapter.SelectCommand.Parameters("@Empleado").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function SP_ServicioPreventivos(ByVal sId_Empresa As String, ByVal dtFechaIni As DateTime, ByVal dtFechaFin As DateTime) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_VTAS_VentasServicioPreventivos", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@dFechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@dFechaFin").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function SP_VentasXMecanicos(ByVal sId_Empresa As String, ByVal scve_Empleado As String, ByVal dtFechaIni As DateTime, ByVal dtFechaFin As DateTime) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_VTAS_VentasporMecanico", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@scve_Empleado", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@scve_Empleado").Value = scve_Empleado
        dAdapter.SelectCommand.Parameters("@scve_Empleado").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@dFechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@dFechaFin").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Inf_Tal_Comisiones_Mecanicos(ByVal sId_Empresa As String, ByVal dtFechaIni As DateTime, ByVal dtFechaFin As DateTime, ByVal sClave As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_TAL_COMISIONES_MECANICOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sClave", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sClave").Value = sClave
        dAdapter.SelectCommand.Parameters("@sClave").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@dFechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@dFechaFin").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Inf_Tal_Comisiones_Mecanicos_vtas(ByVal sId_Empresa As String, ByVal dtFechaIni As DateTime, ByVal dtFechaFin As DateTime, ByVal sClave As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_TAL_COMISIONES_MECANICOS_VTAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sClave", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sClave").Value = sClave
        dAdapter.SelectCommand.Parameters("@sClave").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@dFechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dFechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@dFechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@dFechaFin").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Ejercicios(ByVal sId_Empresa As String, ByVal sId_Sucursal As String, ByVal sEjercicio As String, ByVal sMes As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("SP_COMPULSA_ALM_CONTA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@EMPRESA", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@EMPRESA").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@EMPRESA").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@SUCURSAL", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@SUCURSAL").Value = sId_Sucursal
        dAdapter.SelectCommand.Parameters("@SUCURSAL").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@EJERCICIO", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@EJERCICIO").Value = sEjercicio
        dAdapter.SelectCommand.Parameters("@EJERCICIO").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@MES", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@MES").Value = sMes
        dAdapter.SelectCommand.Parameters("@MES").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function SP_COMPULSA_ALM_CONTA_A(ByVal sId_Empresa As String, ByVal sId_Sucursal As String, ByVal sEjercicio As String, ByVal sMes As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("SP_COMPULSA_ALM_CONTA_A", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@EMPRESA", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@EMPRESA").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@EMPRESA").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@SUCURSAL", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@SUCURSAL").Value = sId_Sucursal
        dAdapter.SelectCommand.Parameters("@SUCURSAL").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@EJERCICIO", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@EJERCICIO").Value = sEjercicio
        dAdapter.SelectCommand.Parameters("@EJERCICIO").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@MES", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@MES").Value = sMes
        dAdapter.SelectCommand.Parameters("@MES").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Temp_SP_InsertaRegistroAEvento(ByVal Nombre As String, ByVal Estado As String, ByVal Municipio As String, ByVal NumPlantas As Integer, ByVal SupPlantar As Decimal, ByVal SupxPlantar As Decimal) As String

        Dim Cm As SqlCommand = Nothing


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm = New SqlCommand("Temp_SP_InsertaRegistroAEvento", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@Nombre", SqlDbType.NVarChar, 500)
        Cm.Parameters("@Nombre").Value = Nombre
        Cm.Parameters("@Nombre").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Estado", SqlDbType.NVarChar, 250)
        Cm.Parameters("@Estado").Value = Estado
        Cm.Parameters("@Estado").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Municipio", SqlDbType.NVarChar, 250)
        Cm.Parameters("@Municipio").Value = Municipio
        Cm.Parameters("@Municipio").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@NumPlantas", SqlDbType.Int)
        Cm.Parameters("@NumPlantas").Value = NumPlantas
        Cm.Parameters("@NumPlantas").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@SupPlantada", SqlDbType.Decimal, (18))
        Cm.Parameters("@SupPlantada").Value = SupPlantar
        Cm.Parameters("@SupPlantada").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@SupxPlantar", SqlDbType.Decimal, (18))
        Cm.Parameters("@SupxPlantar").Value = SupxPlantar
        Cm.Parameters("@SupxPlantar").Direction = ParameterDirection.Input


        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 250)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        Cm.ExecuteNonQuery()

        Temp_SP_InsertaRegistroAEvento = Cm.Parameters("@msg").Value

        Cm = Nothing


        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function CRM_SELECT(ByVal Mes As String, ByVal Ejercicio As String) As DataSet
        'ByVal Empleado As String
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String
        Dim SqlWhere As String
        SqlWhere = ""
        Sql = ""
        Sql = Sql & " "
        Sql = Sql & " select caso, fechacreacion, id_cliente, genera, TipoCaso, descripcion, EstatusCaso from casos "
        Sql = Sql & " where year(fechacreacion)=" & Ejercicio & " and month(fechacreacion) = " & Mes & " "
        Sql = Sql & " Order By fechacreacion "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If


    End Function
    <WebMethod()> _
    Public Function CRM_INSERT() As DataSet
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Dim Sql As String
        Dim SqlWhere As String
        SqlWhere = ""


        Sql = ""
        Sql = Sql & " "
        Sql = Sql & " SELECT E.Cve_Empleado,E.NOMBRE "
        Sql = Sql & " FROM NomEmpleados E"
        Sql = Sql & " INNER JOIN NomDepartamentos D ON E.CVE_DEPTO =D.cve_depto  "
        Sql = Sql & " INNER JOIN NomPuestos P ON E.Id_Puesto  =P.Id_Puesto "
        Sql = Sql & " WHERE E.ESTATUS='ACTIVO'"
        Sql = Sql & " AND D.Descripcion LIKE '%TALLER%'"
        Sql = Sql & Sql & " Order By E.Cve_Empleado "

        dAdapter = New SqlDataAdapter(Sql, Globales.SqlConn)
        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If


    End Function

    <WebMethod()> _
    Public Function TareasSolicitadas(ByVal Id_Solicita As String) As DataSet

        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.TAREAS_SP_TAREAS_SOLICITADAS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Solicita", SqlDbType.NVarChar, 5)
        dAdapter.SelectCommand.Parameters("@Id_Solicita").Value = Id_Solicita
        dAdapter.SelectCommand.Parameters("@Id_Solicita").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function TareaReporte(ByVal dtFechaIni As String, ByVal dtFechaFin As String, ByVal sEstatus As String, ByVal Id_Solicita As Integer, ByVal Id_Responsable As Integer) As DataSet

        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.TAREAS_SP_TAREAS_REPORTE", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@FechaIni", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@FechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@FechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaFin", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@FechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@FechaFin").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Estatus", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@Estatus").Value = sEstatus
        dAdapter.SelectCommand.Parameters("@Estatus").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Id_Solicita", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@Id_Solicita").Value = Id_Solicita
        dAdapter.SelectCommand.Parameters("@Id_Solicita").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Id_Responsable", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@Id_Responsable").Value = Id_Responsable
        dAdapter.SelectCommand.Parameters("@Id_Responsable").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function TareasPendientes(ByVal Id_Responsable As String) As DataSet
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.TAREAS_SP_TAREAS_PENDIENTES", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Responsable", SqlDbType.NVarChar, 5)
        dAdapter.SelectCommand.Parameters("@Id_Responsable").Value = Id_Responsable
        dAdapter.SelectCommand.Parameters("@Id_Responsable").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function AltaComentarios(ByVal Id_Usuario As String, ByVal Id_Tarea As String, ByVal Comentario As String) As DataSet
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.TAREAS_SP_INSSERTA_COMENTARIO", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Usuario", SqlDbType.NVarChar, 150)
        dAdapter.SelectCommand.Parameters("@Id_Usuario").Value = Id_Usuario
        dAdapter.SelectCommand.Parameters("@Id_Usuario").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Id_Tarea", SqlDbType.NVarChar, 5)
        dAdapter.SelectCommand.Parameters("@Id_Tarea").Value = Id_Tarea
        dAdapter.SelectCommand.Parameters("@Id_Tarea").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Comentario", SqlDbType.NVarChar, 1500)
        dAdapter.SelectCommand.Parameters("@Comentario").Value = Comentario
        dAdapter.SelectCommand.Parameters("@Comentario").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function FinComentariosTareas(ByVal id_usuario As String, ByVal Id_tarea As String) As String
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(3)

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm = New SqlCommand("TAREAS_SP_BORRA_TAREA", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@id_usuario", SqlDbType.NVarChar, 5)
        Cm.Parameters("@id_usuario").Value = id_usuario
        Cm.Parameters("@id_usuario").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Id_tarea", SqlDbType.NVarChar, 5)
        Cm.Parameters("@Id_tarea").Value = Id_tarea
        Cm.Parameters("@Id_tarea").Direction = ParameterDirection.Input

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value

        FinComentariosTareas = aData(0)

        Cm = Nothing

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function TerComentariosTareas(ByVal id_usuario As String, ByVal Id_tarea As String) As String
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(3)

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm = New SqlCommand("TAREAS_SP_TERMINA_TAREA", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@id_usuario", SqlDbType.NVarChar, 5)
        Cm.Parameters("@id_usuario").Value = id_usuario
        Cm.Parameters("@id_usuario").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Id_tarea", SqlDbType.NVarChar, 5)
        Cm.Parameters("@Id_tarea").Value = Id_tarea
        Cm.Parameters("@Id_tarea").Direction = ParameterDirection.Input

        Cm.ExecuteNonQuery()

        'aData(0) =`0 Cm.Parameters("@iError").Value

        TerComentariosTareas = "0"

        Cm = Nothing

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function ComentariosTareas(ByVal id_tarea As String, ByVal id_usuario As String) As DataSet
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.TAREAS_SP_TAREAS_COMENTARIOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_tarea", SqlDbType.NVarChar, 5)
        dAdapter.SelectCommand.Parameters("@Id_tarea").Value = id_tarea
        dAdapter.SelectCommand.Parameters("@Id_tarea").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@id_usuario", SqlDbType.NVarChar, 5)
        dAdapter.SelectCommand.Parameters("@id_usuario").Value = id_usuario
        dAdapter.SelectCommand.Parameters("@id_usuario").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function RegistrarTarea(ByVal Asunto As String, ByVal Id_Solicita As Integer, ByVal Id_Responsable As Integer) As String()
        'On Error GoTo errR

        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm = New SqlCommand("TAREAS_SP_INSERTA_TAREA", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@Asunto", SqlDbType.NVarChar, 1500)
        Cm.Parameters("@Asunto").Value = Asunto
        Cm.Parameters("@Asunto").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Id_Solicita", SqlDbType.Int)
        Cm.Parameters("@Id_Solicita").Value = Id_Solicita
        Cm.Parameters("@Id_Solicita").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@Id_Responsable", SqlDbType.Int)
        Cm.Parameters("@Id_Responsable").Value = Id_Responsable
        Cm.Parameters("@Id_Responsable").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 250)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        RegistrarTarea = aData

        Cm = Nothing

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function DetalleFacturas(ByVal sMovimiento As String) As DataSet
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("web.SP_SELECT_FACTDETALLE", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sMovimiento", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@sMovimiento").Value = sMovimiento
        dAdapter.SelectCommand.Parameters("@sMovimiento").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function AutSelect(ByVal sId_Empresa As String, ByVal sEstatus As String, ByVal sFechaIni As String, ByVal sFechaFin As String, ByVal sSucursal As String, ByVal iSolicita As Integer, ByVal iResponsable As Integer, ByVal sDepto As String) As DataSet
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("AUT_SP_SELECT_AUTORIZACIONES", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sEstatus", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@sEstatus").Value = sEstatus
        dAdapter.SelectCommand.Parameters("@sEstatus").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sFechaIni", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@sFechaIni").Value = sFechaIni
        dAdapter.SelectCommand.Parameters("@sFechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sFechaFin", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@sFechaFin").Value = sFechaFin
        dAdapter.SelectCommand.Parameters("@sFechaFin").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sSucursal", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@sSucursal").Value = sSucursal
        dAdapter.SelectCommand.Parameters("@sSucursal").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iSolicita", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iSolicita").Value = iSolicita
        dAdapter.SelectCommand.Parameters("@iSolicita").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iResponsable", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iResponsable").Value = iResponsable
        dAdapter.SelectCommand.Parameters("@iResponsable").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sDepto", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@sDepto").Value = sDepto
        dAdapter.SelectCommand.Parameters("@sDepto").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    '<WebMethod()> _
    'Public Function AutInsertSelect(ByVal sMovimientos As Array) As DataSet
    '    'On Error GoTo errR

    '    Dim dt As New DataTable

    '    dAdapter = New SqlDataAdapter("AUT_SP_INSERT_SELEC_AUTORIZACIONES", Globales.SqlConn)
    '    dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

    '    dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 5000)
    '    dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sMovimientos
    '    dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

    '    If Globales.SqlConn.State = ConnectionState.Closed Then
    '        Globales.SqlConn.Open()
    '    End If

    '    dAdapter.Fill(dSet)

    '    Return dSet

    '    If Globales.SqlConn.State = ConnectionState.Open Then
    '        Globales.SqlConn.Close()
    '    End If
    'End Function

    <WebMethod()> _
    Public Function TallerMecBit(ByVal Empresa As String, ByVal Cve_Mecanico As String, ByVal FechaIni As DateTime, ByVal FechaFin As DateTime) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_TALLER_MECANICOS_VTAS_BITACORA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Cve_Mecanico", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Cve_Mecanico").Value = Cve_Mecanico
        dAdapter.SelectCommand.Parameters("@Cve_Mecanico").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@FechaIni").Value = FechaIni
        dAdapter.SelectCommand.Parameters("@FechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@FechaFin").Value = FechaFin
        dAdapter.SelectCommand.Parameters("@FechaFin").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function TallerMecCasos(ByVal Empresa As String, ByVal Cve_Mecanico As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_TALLER_VTAS_CASOS_ABIERTOS", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input


        dAdapter.SelectCommand.Parameters.Add("@Cve_Mecanico", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Cve_Mecanico").Value = Cve_Mecanico
        dAdapter.SelectCommand.Parameters("@Cve_Mecanico").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function Saldos_ClientesXVendedor(ByVal sId_Empresa As String, ByVal sMoneda As String, ByVal sid_sucursal As String, ByVal sId_Cliente As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CLI_Saldos_ClientesXVendedor", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sId_Sucursal", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sId_Sucursal").Value = sid_sucursal
        dAdapter.SelectCommand.Parameters("@sId_Sucursal").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sMoneda", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sMoneda").Value = sMoneda
        dAdapter.SelectCommand.Parameters("@sMoneda").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@sId_Cliente", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@sId_Cliente").Value = sId_Cliente
        dAdapter.SelectCommand.Parameters("@sId_Cliente").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function pagosfact(ByVal empresa As String, ByVal tipo As String, ByVal moneda As String, ByVal fini As String, ByVal ffin As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_COB_PAGOSFACTURA", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sempresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sempresa").Value = empresa
        dAdapter.SelectCommand.Parameters("@sempresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@stipo", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@stipo").Value = tipo
        dAdapter.SelectCommand.Parameters("@stipo").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@smoneda", SqlDbType.NVarChar, 10)
        dAdapter.SelectCommand.Parameters("@smoneda").Value = moneda
        dAdapter.SelectCommand.Parameters("@smoneda").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dfini", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@dfini").Value = fini
        dAdapter.SelectCommand.Parameters("@dfini").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@dffin", SqlDbType.NVarChar, 20)
        dAdapter.SelectCommand.Parameters("@dffin").Value = ffin
        dAdapter.SelectCommand.Parameters("@dffin").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function AltaPantallas(ByVal sNombre As String, ByVal sDescripcion As String, ByVal sGrupo As String, ByVal sTipo As String, ByVal iModulo As Integer) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)

        Cm = New SqlCommand("Web.php_SP_ALTA_FORMAS", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@sNombre", SqlDbType.NVarChar, 30)
        Cm.Parameters("@sNombre").Value = sNombre
        Cm.Parameters("@sNombre").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sDescripcion", SqlDbType.NVarChar, 30)
        Cm.Parameters("@sDescripcion").Value = sDescripcion
        Cm.Parameters("@sDescripcion").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sGrupo", SqlDbType.NVarChar, 30)
        Cm.Parameters("@sGrupo").Value = sGrupo
        Cm.Parameters("@sGrupo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sTipo", SqlDbType.NVarChar, 3)
        Cm.Parameters("@sTipo").Value = sTipo
        Cm.Parameters("@sTipo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iModulo", SqlDbType.Int)
        Cm.Parameters("@iModulo").Value = iModulo
        Cm.Parameters("@iModulo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 300)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        AltaPantallas = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function SelectGeneral(ByVal sVariable As String) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_SELECT_GENERAL", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sVariable", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sVariable").Value = sVariable
        dAdapter.SelectCommand.Parameters("@sVariable").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function CLI_FactDiariaTaller(ByVal sId_Empresa As String, ByVal dtFechaIni As DateTime, ByVal dtFechaFin As DateTime, ByVal sId_Cliente As String, ByVal sMoneda As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CLI_FACT_DIARIA_TALLER", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Id_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@Id_Empresa").Direction = ParameterDirection.Input


        dAdapter.SelectCommand.Parameters.Add("@FechaIni", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@FechaIni").Value = dtFechaIni
        dAdapter.SelectCommand.Parameters("@FechaIni").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@FechaFin", SqlDbType.DateTime)
        dAdapter.SelectCommand.Parameters("@FechaFin").Value = dtFechaFin
        dAdapter.SelectCommand.Parameters("@FechaFin").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Id_Cliente", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Id_Cliente").Value = sId_Cliente
        dAdapter.SelectCommand.Parameters("@Id_Cliente").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Moneda", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@Moneda").Value = sMoneda
        dAdapter.SelectCommand.Parameters("@Moneda").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function PerfilesSelect(ByVal sId_Empresa As String, ByVal iId As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR vvv

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_PERFILES_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iId", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId").Value = iId
        dAdapter.SelectCommand.Parameters("@iId").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function AccesosSelect(ByVal sId_Empresa As String, ByVal iId As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_ACCESOS_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iId", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId").Value = iId
        dAdapter.SelectCommand.Parameters("@iId").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function GruposSelect(ByVal sId_Empresa As String, ByVal iId As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_GRUPO_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iId", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId").Value = iId
        dAdapter.SelectCommand.Parameters("@iId").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function PerfilSelect(ByVal sId_Empresa As String, ByVal iId As Integer) As DataSet
        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("Web.php_SP_CTRL_PERFIL_SELECT", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@sId_Empresa", SqlDbType.NVarChar, 15)
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Value = sId_Empresa
        dAdapter.SelectCommand.Parameters("@sId_Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@iId", SqlDbType.Int)
        dAdapter.SelectCommand.Parameters("@iId").Value = iId
        dAdapter.SelectCommand.Parameters("@iId").Direction = ParameterDirection.Input


        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function GruposInsert(sGrupo As String, iId As Integer) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)

        Cm = New SqlCommand("Web.php_SP_CTRL_GRUPOS_ABC", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@iOpc", SqlDbType.Int)
        Cm.Parameters("@iOpc").Value = 1
        Cm.Parameters("@iOpc").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = 0
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sGrupo", SqlDbType.Int)
        Cm.Parameters("@sGrupo").Value = sGrupo
        Cm.Parameters("@sGrupo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 300)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        GruposInsert = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function PerfilInsert(sPerfil As String, iId As Integer) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)

        Cm = New SqlCommand("Web.php_SP_CTRL_PERFIL_ABC", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@iOpc", SqlDbType.Int)
        Cm.Parameters("@iOpc").Value = 1
        Cm.Parameters("@iOpc").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = 0
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sPerfil", SqlDbType.NVarChar, 20)
        Cm.Parameters("@sPerfil").Value = sPerfil
        Cm.Parameters("@sPerfil").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 300)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        PerfilInsert = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
    <WebMethod()> _
    Public Function GruposUpdate(sGrupo As String, iId As Integer) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)

        Cm = New SqlCommand("Web.php_SP_CTRL_GRUPOS_ABC", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@iOpc", SqlDbType.Int)
        Cm.Parameters("@iOpc").Value = 1
        Cm.Parameters("@iOpc").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = 0
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sGrupo", SqlDbType.Int)
        Cm.Parameters("@sGrupo").Value = sGrupo
        Cm.Parameters("@sGrupo").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iError", SqlDbType.Int)
        Cm.Parameters("@iError").Direction = ParameterDirection.Output

        Cm.Parameters.Add("@msg", SqlDbType.NVarChar, 300)
        Cm.Parameters("@msg").Direction = ParameterDirection.Output

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        GruposUpdate = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()>
    Public Function PerfilUpdate(sPerfil As String, iId As Integer) As String()
        Dim Cm As SqlCommand = Nothing
        Dim aData As String()
        ReDim aData(2)

        Cm = New SqlCommand("Web.php_SP_CTRL_PERFIL_ABC", Globales.SqlConn)
        Cm.CommandType = CommandType.StoredProcedure

        Cm.Parameters.Add("@iOpc", SqlDbType.Int)
        Cm.Parameters("@iOpc").Value = 1
        Cm.Parameters("@iOpc").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@iId", SqlDbType.Int)
        Cm.Parameters("@iId").Value = 0
        Cm.Parameters("@iId").Direction = ParameterDirection.Input

        Cm.Parameters.Add("@sPerfil", SqlDbType.NVarChar, 20)
        Cm.Parameters("@sPerfil").Value = sPerfil
        Cm.Parameters("@sPerfil").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If

        Cm.ExecuteNonQuery()

        aData(0) = Cm.Parameters("@iError").Value
        aData(1) = Cm.Parameters("@msg").Value

        PerfilUpdate = aData

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function edobalancegeneral_lv3(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal id_cuentactb As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_BALANCE_LV3", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@id_cuentactb", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@id_cuentactb").Value = id_cuentactb
        dAdapter.SelectCommand.Parameters("@id_cuentactb").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function

    <WebMethod()> _
    Public Function edobalancegeneral_lv4(ByVal Empresa As String, ByVal Mes As String, ByVal Ejercicio As String, ByVal id_cuentactb As String) As DataSet

        Dim Cm As SqlCommand = Nothing
        'On Error GoTo errR

        Dim dt As New DataTable

        dAdapter = New SqlDataAdapter("dbo.CONTA_SP_BALANCE_LV4", Globales.SqlConn)
        dAdapter.SelectCommand.CommandType = CommandType.StoredProcedure

        dAdapter.SelectCommand.Parameters.Add("@Empresa", SqlDbType.NVarChar, 12)
        dAdapter.SelectCommand.Parameters("@Empresa").Value = Empresa
        dAdapter.SelectCommand.Parameters("@Empresa").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Mes", SqlDbType.NVarChar, 2)
        dAdapter.SelectCommand.Parameters("@Mes").Value = Mes
        dAdapter.SelectCommand.Parameters("@Mes").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@Ejercicio", SqlDbType.NVarChar, 4)
        dAdapter.SelectCommand.Parameters("@Ejercicio").Value = Ejercicio
        dAdapter.SelectCommand.Parameters("@Ejercicio").Direction = ParameterDirection.Input

        dAdapter.SelectCommand.Parameters.Add("@id_cuentactb", SqlDbType.NVarChar, 25)
        dAdapter.SelectCommand.Parameters("@id_cuentactb").Value = id_cuentactb
        dAdapter.SelectCommand.Parameters("@id_cuentactb").Direction = ParameterDirection.Input

        If Globales.SqlConn.State = ConnectionState.Closed Then
            Globales.SqlConn.Open()
        End If


        dAdapter.Fill(dSet)

        Return dSet

        If Globales.SqlConn.State = ConnectionState.Open Then
            Globales.SqlConn.Close()
        End If
    End Function
End Class