using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Runtime.InteropServices;
using System.Diagnostics;
using System.Threading;
using System.IO;
using MySql;
using MySql.Data;
using MySql.Data.MySqlClient;
using TagLib;
using System.Text.RegularExpressions;





namespace Control_de_Winamp
{
    public partial class Form1 : Form
    {
        private const int CP_NOCLOSE_BUTTON = 0x200;
        public const int WM_USER = 0x400;
        public const int WM_COMMAND = 0x0111;
        const string strTtlEnd = " - Winamp";
        [DllImport("user32.dll")]
        public static extern IntPtr FindWindow(string lpClassName, string lpWindowName);
        [DllImport("user32.dll", CharSet = CharSet.Auto)]
        private static extern int SendMessage(IntPtr hWnd, int msg, int wParam, int lParam);
        [DllImport("user32.dll", CharSet = System.Runtime.InteropServices.CharSet.Auto)]
        public static extern int GetWindowText(IntPtr hwnd, string lpString, int cch);
        private MySqlConnection connection = new MySqlConnection();
        private MySqlConnection connection2 = new MySqlConnection();
        private MySqlDataAdapter data = new MySqlDataAdapter();
        Form2 caja;
        IntPtr hwndWinamp;
        ThreadStart worker;
        public Thread orolas;        
        int omitidos, errores, agregados;
        string[] files;
        string WPlaylistPath, TPlaylistPath, WinampPath, generoactual,generoanterior;         
        protected override CreateParams CreateParams
        {
            get
            {
                CreateParams myCp = base.CreateParams;
                myCp.ClassStyle = myCp.ClassStyle | CP_NOCLOSE_BUTTON;
                return myCp;
            }
        }       
        public Form1()
        {
            InitializeComponent();
            omitidos = 0;
            errores = 0;
            agregados = 0;
            caja = new Form2();
            WPlaylistPath = Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData) + "\\Winamp\\Winamp.m3u";
            TPlaylistPath = Environment.GetFolderPath(Environment.SpecialFolder.ApplicationData) + "\\Winamp\\tmp.m3u";
            WinampPath = Environment.GetFolderPath(Environment.SpecialFolder.ProgramFiles) + "\\Winamp\\Winamp.exe";
            hwndWinamp = FindWindow("Winamp v1.x",null);
            connection.ConnectionString = "Server=204.152.255.18;Database=a11117ho_radioiit;Uid=a11117ho_db;Pwd=password890;Allow Zero Datetime=true;";
            connection2.ConnectionString = "Server=204.152.255.18;Database=a11117ho_radioiit;Uid=a11117ho_db;Pwd=password890;Allow Zero Datetime=true;";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;           
        }   
        
        
        private void Form1_Load(object sender, EventArgs e)
        {            
            this.Opacity = 0.0f;
            this.ShowInTaskbar = false;
            this.TopLevel = false;
            try
            {
                connection.Open();
                if (hwndWinamp == IntPtr.Zero)
                {
                    ProcessStartInfo Winampdir = new ProcessStartInfo(WinampPath);
                    Process RunWinamp = Process.Start(Winampdir);
                    Thread.Sleep(3000);
                    hwndWinamp = FindWindow("Winamp v1.x", null);
                }
                Thread.Sleep(20000);
                MySqlCommand selectt2 = connection.CreateCommand();
                selectt2.CommandText = "SELECT * from canciones";
                DataSet datasett2 = new DataSet();
                MySqlDataAdapter dataa2 = new MySqlDataAdapter();
                dataa2.SelectCommand = selectt2;
                connection.Close();
                try
                {
                    dataa2.Fill(datasett2, "canciones");
                }
                catch { }
                if (datasett2.Tables["canciones"].Rows.Count == 0)
                {
                    MessageBox.Show("Por favor, primero agregue canciones al catálogo");
                    this.Opacity = 100.0f;
                    this.ShowInTaskbar = true;
                    this.TopLevel = true;
                    this.Focus();
                    checkBox1.Enabled = false;
                    actualizarToolStripMenuItem.Enabled = false;
                }
                else
                {
                    DateTime dia = DateTime.Now;
                    string sdia = dia.DayOfWeek.ToString();
                    switch (sdia)
                    {
                        case "Monday":
                            sdia = "lunes";
                            break;
                        case "Tuesday":
                            sdia = "martes";
                            break;
                        case "Wednesday":
                            sdia = "miercoles";
                            break;
                        case "Thursday":
                            sdia = "jueves";
                            break;
                        case "Friday":
                            sdia = "viernes";
                            break;
                        case "Saturday":
                            sdia = "sabado";
                            break;
                        case "Sunday":
                            sdia = "domingo";
                            break;
                    }
                    string hora = DateTime.Now.ToString("HH:mm:ss", System.Globalization.DateTimeFormatInfo.InvariantInfo);
                    try
                    {
                        connection.Open();
                    }
                    catch { }
                    MySqlCommand selectt = connection.CreateCommand();
                    selectt.CommandText = "SELECT horarios.generos FROM horarios WHERE horarios.dia = '" + sdia + "' AND horarios.tiempo_inicial <= '" + hora + "' AND horarios.tiempo_final > '" + hora + "'";
                    DataSet datasett = new DataSet();
                    MySqlDataAdapter dataa = new MySqlDataAdapter();
                    dataa.SelectCommand = selectt;
                    try
                    {
                        dataa.Fill(datasett, "generoact");
                    }
                    catch { }
                    MySqlCommand select2 = connection.CreateCommand();
                    DataSet dataset2 = new DataSet();
                    MySqlDataAdapter data2 = new MySqlDataAdapter();
                    if (datasett.Tables["generoact"].Rows.Count == 0)
                    {
                        select2.CommandText = "SELECT canciones.id, canciones.ruta, canciones.genero FROM canciones ORDER BY `canciones`.`cantidad_pedidas`";
                        generoactual = "Todos";
                        generoanterior = "Todos";
                    }
                    else
                    {
                        select2.CommandText = "SELECT canciones.id, canciones.ruta, canciones.genero FROM canciones WHERE FIND_IN_SET( canciones.genero, ( SELECT horarios.generos FROM horarios WHERE horarios.dia = '" + sdia + "' AND horarios.tiempo_inicial <= '" + hora + "' AND horarios.tiempo_final > '" + hora + "')) ORDER BY `canciones`.`cantidad_pedidas`";
                        generoactual = datasett.Tables["generoact"].Rows[0][0].ToString();
                        generoanterior = datasett.Tables["generoact"].Rows[0][0].ToString();
                    }
                    data2.SelectCommand = select2;
                    try
                    {
                        data2.Fill(dataset2, "Cgeneroact");
                    }
                    catch { }
                    SendMessage(hwndWinamp, WM_USER, 0, 101);
                    SendMessage(hwndWinamp, WM_USER, 0, 120);
                    MySqlCommand erase = connection.CreateCommand();
                    erase.CommandText = "TRUNCATE TABLE peticiones";
                    try
                    {
                        erase.ExecuteNonQuery();
                    }
                    catch { }
                    MySqlCommand erase2 = connection.CreateCommand();
                    erase2.CommandText = "TRUNCATE TABLE playlist_actual";
                    try
                    {
                        erase2.ExecuteNonQuery();
                    }
                    catch { }
                    MySqlCommand cant_ped = connection.CreateCommand();
                    cant_ped.CommandText = "UPDATE canciones SET cantidad_pedidas=cantidad_pedidas+1 WHERE id=" + dataset2.Tables["Cgeneroact"].Rows[0]["id"];
                    try
                    {
                        cant_ped.ExecuteNonQuery();
                    }
                    catch { }
                    MySqlCommand app_running = connection.CreateCommand();
                    app_running.CommandText = "UPDATE configuracion_sitio SET valor='false'  WHERE llave='de_vacas'";
                    try
                    {
                        app_running.ExecuteNonQuery();
                    }
                    catch { }
                    connection.Close();
                    if (System.IO.File.Exists(TPlaylistPath) == true)
                        System.IO.File.Delete(TPlaylistPath);
                    FileStream TPlaylist = new FileStream(TPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite | FileShare.Delete);
                    StreamWriter newline = new StreamWriter(TPlaylist, Encoding.Default);
                    newline.WriteLine("#EXTM3U");
                    newline.WriteLine("#EXTINF:");
                    newline.WriteLine(dataset2.Tables["Cgeneroact"].Rows[0]["ruta"].ToString());
                    newline.Flush();
                    newline.Close();
                    newline.Dispose();
                    TPlaylist.Close();
                    TPlaylist.Dispose();
                    ProcessStartInfo DirTmpPlaylist = new ProcessStartInfo(TPlaylistPath);
                    Process RunTmpPlaylist = Process.Start(DirTmpPlaylist);
                    Thread.Sleep(1000);
                    SendMessage(hwndWinamp, WM_USER, 0, 120);
                    actualizarplaylist();
                    timer1.Enabled = true;
                }   
            }
            catch 
            {
                DialogResult result1=MessageBox.Show("Error en la conexión con el servidor.\nCompruebe si tiene conexión a Internet o llame al administrador.","Error en la conexión",MessageBoxButtons.OK);
                if (result1 == DialogResult.OK)
                    this.Close();
            }                                           
        }

        private void actualizarToolStripMenuItem_Click(object sender, EventArgs e)
        {           
            this.Opacity = 100.0f;
            this.ShowInTaskbar = true;
            this.TopLevel = true;
            this.Focus();
            actualizarToolStripMenuItem.Enabled = false;
            try
            {
                connection.Open();
            }
            catch { }
            MySqlCommand selectt2 = connection.CreateCommand();
            selectt2.CommandText = "SELECT * from canciones";
            DataSet datasett2 = new DataSet();
            MySqlDataAdapter dataa2 = new MySqlDataAdapter();
            dataa2.SelectCommand = selectt2;
            connection.Close();
            try
            {
                dataa2.Fill(datasett2, "canciones");
            }
            catch { }
            if (datasett2.Tables["canciones"].Rows.Count == 0)
                checkBox1.Enabled = false;
            else
                checkBox1.Enabled = true;
        }

        private void salirToolStripMenuItem_Click(object sender, EventArgs e)
        {            
            this.Close();
        }

        private void button2_Click(object sender, EventArgs e)
        {            
            try
            {
                files = Directory.GetFiles(textBox1.Text, "*.mp3", SearchOption.AllDirectories);                
                salirToolStripMenuItem.Enabled = false;
                textBox1.Enabled = false;
                checkBox1.Enabled = false;
                button1.Enabled = false;
                button2.Enabled = false;
                button3.Text = "Cancelar";
                button3.Font= new Font (button3.Font, button3.Font.Style | FontStyle.Bold);
                progressBar1.Visible = true;
                label6.Visible = true;
                progressBar1.Maximum = files.Length;
                worker = new ThreadStart(getid3);
                orolas = new Thread(new ThreadStart(worker));
                orolas.Start();                
            }
            catch
            {
                MessageBox.Show("El directorio ingresado no existe.");                
            }            
        }

        private void button1_Click(object sender, EventArgs e)
        {
            DialogResult result = folderBrowserDialog1.ShowDialog();
            if (result == DialogResult.OK)
            {
                textBox1.Text = "";
                textBox1.Text = folderBrowserDialog1.SelectedPath.ToString();
                textBox1.Select(textBox1.Text.Length, 0);                
                button2.Focus();
            }
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
    {
            if (textBox1.Text != "")
                button2.Enabled = true;
            else
                button2.Enabled = false;            
        }

        public void getid3()
        {
            try
            {
                connection2.Open();
                MySqlCommand app_running = connection2.CreateCommand();
                app_running.CommandText = "UPDATE configuracion_sitio SET valor='true'  WHERE llave='de_vacas'";
                try
                {
                    app_running.ExecuteNonQuery();
                }
                catch { }
                connection2.Close();
            }
            catch { }            
            bool omitido=false;
            errores = 0;
            agregados = 0;
            omitidos = 0;
            Invoke(new Action(() => caja.listBox1.Items.Clear()));
            if (this.checkBox1.Checked == true)
            {                
                try
                {
                    connection2.Open();
                    MySqlCommand erase = connection2.CreateCommand();
                    erase.CommandText = "TRUNCATE TABLE canciones";
                    try
                    {
                        erase.ExecuteNonQuery();
                    }
                    catch { }
                    MySqlCommand erase2 = connection2.CreateCommand();
                    erase2.CommandText = "TRUNCATE TABLE peticiones";
                    try
                    {
                        erase2.ExecuteNonQuery();
                    }
                    catch { }
                    connection2.Close();
                }
                catch { }                 
            }                
            for (int x = 0; x < files.Length; x++)
            {
                int fg=files[x].Count();
                if (fg <= 100)
                {
                    TagLib.File file = TagLib.File.Create(files[x]);
                    if (file.Tag.FirstPerformer != null && file.Tag.Title != null)
                    {
                        omitido = insertardatos(file.Tag.Title, file.Tag.FirstPerformer, file.Tag.Album, file.Tag.FirstGenre, files[x], file.Properties.Duration.TotalSeconds);
                        if (omitido == false)
                        {
                            agregados += 1;
                        }
                        else
                        {
                            omitidos += 1;
                        }
                    }
                    else
                    {
                        errores += 1;
                        Invoke(new Action(() => caja.listBox1.Items.Add(files[x])));
                    }  
                }
                else
                {
                    errores += 1;
                    Invoke(new Action(() => caja.listBox1.Items.Add(files[x])));
                }
                Invoke(new Action(() => progressBar1.Value += 1));                                              
            }           
            if (errores == 0)
                MessageBox.Show("Archivos encontrados: " + files.Length + "\n" +
                            "Archivos agregados: " + agregados + "\n" +
                            "Archivos omitidos: " + omitidos);
            else
            {                
                caja.label6.Text = files.Length.ToString();
                caja.label7.Text = agregados.ToString();
                caja.label8.Text = omitidos.ToString();
                caja.label9.Text = errores.ToString();                
                caja.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
                Invoke(new Action(() => caja.ShowDialog(this)));                
            }
            Invoke(new Action(() => textBox1.Enabled = true));
            Invoke(new Action(() => checkBox1.Enabled = true));
            Invoke(new Action(() => button1.Enabled = true));
            Invoke(new Action(() => button2.Enabled = true));
            Invoke(new Action(() => progressBar1.Visible = false));
            Invoke(new Action(() => progressBar1.Value=0));
            Invoke(new Action(() => label6.Visible = false));
            Invoke(new Action(() => salirToolStripMenuItem.Enabled = true));
            Invoke(new Action(() => button3.Text = "Cerrar"));
            Invoke(new Action(() => button3.Font = new Font(button3.Font, button3.Font.Style | FontStyle.Regular)));            
            Invoke(new Action(() => timer1.Enabled = true));
            try
            {
                connection2.Open();
                MySqlCommand app_running = connection2.CreateCommand();
                app_running.CommandText = "UPDATE configuracion_sitio SET valor='false'  WHERE llave='de_vacas'";
                try
                {
                    app_running.ExecuteNonQuery();
                }
                catch { }
                connection2.Close();
            }
            catch { }            
        }

        public bool insertardatos(string titulo, string artista, string album, string genero, string ruta, double duracion)
        {
            bool omitido=false;           
            try
            {
                connection2.Open();
            }
            catch { }            
            MySqlCommand select = connection2.CreateCommand();            
            select.CommandText = "select * from canciones";                            
            DataSet dataset = new DataSet();
            data.SelectCommand = select;
            data.Fill(dataset, "canciones");
            int rows = dataset.Tables["canciones"].Rows.Count;
            if (rows == 0)
            {
                DataRow newrow = dataset.Tables["canciones"].NewRow();
                newrow["ruta"] = ruta;
                newrow["titulo"] = titulo;
                newrow["artista"] = artista;
                newrow["album"] = album;
                newrow["genero"] = genero;
                newrow["duracion"] = duracion;
                dataset.Tables["canciones"].Rows.Add(newrow);
                MySqlCommandBuilder mbuild = new MySqlCommandBuilder(data);                
                try
                {
                    data.Update(dataset, "canciones");
                    omitido = false;
                }
                catch {}
            }
            else
            {
                for (int y = 0; y < rows; y++)
                {
                    if ((artista == dataset.Tables["canciones"].Rows[y]["artista"].ToString()) && (titulo == dataset.Tables["canciones"].Rows[y]["titulo"].ToString()))
                    {
                        omitido= true;
                        break;
                    }
                    else if (y == (rows - 1))
                    {
                        DataRow newrow = dataset.Tables["canciones"].NewRow();
                        newrow["ruta"] = ruta;
                        newrow["titulo"] = titulo;
                        newrow["artista"] = artista;
                        newrow["album"] = album;
                        newrow["genero"] = genero;
                        newrow["duracion"] = duracion;
                        dataset.Tables["canciones"].Rows.Add(newrow);
                        MySqlCommandBuilder mbuild = new MySqlCommandBuilder(data);                        
                        try
                        {
                            data.Update(dataset, "canciones");
                            omitido = false;
                        }
                        catch {}
                    }
                }
            }            
            connection2.Close();
            return omitido;
        }

        private void button3_Click(object sender, EventArgs e)
        {           
            if (connection2.State == System.Data.ConnectionState.Open)
            {
                connection2.Close();
            }
            if (button3.Text == "Cancelar")
            {
                while (orolas.IsAlive == true)
                {
                    try
                    {
                        orolas.Abort();
                        Thread.Sleep(3000);
                    }
                    catch { }
                }
                if (errores == 0)
                    MessageBox.Show("Archivos encontrados: " + files.Length + "\n" +
                                "Archivos agregados: " + agregados + "\n" +
                                "Archivos omitidos: " + omitidos);
                else
                {
                    caja.label6.Text = files.Length.ToString();
                    caja.label7.Text = agregados.ToString();
                    caja.label8.Text = omitidos.ToString();
                    caja.label9.Text = errores.ToString();
                    caja.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
                    Invoke(new Action(() => caja.ShowDialog(this)));
                }
                textBox1.Enabled = true;                
                checkBox1.Enabled = true;
                button1.Enabled = true;
                button2.Enabled = true;
                progressBar1.Visible = false;
                progressBar1.Value = 0;
                label6.Visible = false;
                salirToolStripMenuItem.Enabled = true;
                button3.Text = "Cerrar";
                button3.Font = new Font(button3.Font, button3.Font.Style | FontStyle.Regular);
            }
            else
            {
                this.ShowInTaskbar = false;
                this.Opacity = 0.0f;
                this.TopLevel = false;                
                actualizarToolStripMenuItem.Enabled = true;
                textBox1.Text = "";
            }
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            hwndWinamp = FindWindow("Winamp v1.x", null);
            if (hwndWinamp != IntPtr.Zero)
            {
                if (SendMessage(hwndWinamp, WM_USER, 0, 104) == 1 /*&& (SendMessage(hwndWinamp, WM_USER, 1, 125)) == 0*/)
                {                    
                    int length = SendMessage(hwndWinamp, WM_USER, 1, 105);
                    float position = (SendMessage(hwndWinamp, WM_USER, 0, 105) / 1000);
                    string actualcancion = GetSongTitle();
                    string[] titulo = Regex.Split(actualcancion, " - ");
                    if ((length - Math.Floor(position)) <= 2)
                    {                        
                        timer1.Enabled = false;
                        SendMessage(hwndWinamp, WM_COMMAND, 40046, 0);
                        if (generoactual != generoanterior)
                        {
                            SendMessage(hwndWinamp, WM_USER, 0, 101);
                            SendMessage(hwndWinamp, WM_USER, 0, 120);
                            DateTime dia = DateTime.Now;
                            string sdia = dia.DayOfWeek.ToString();
                            switch (sdia)
                            {
                                case "Monday":
                                    sdia = "lunes";
                                    break;
                                case "Tuesday":
                                    sdia = "martes";
                                    break;
                                case "Wednesday":
                                    sdia = "miercoles";
                                    break;
                                case "Thursday":
                                    sdia = "jueves";
                                    break;
                                case "Friday":
                                    sdia = "viernes";
                                    break;
                                case "Saturday":
                                    sdia = "sabado";
                                    break;
                                case "Sunday":
                                    sdia = "domingo";
                                    break;
                            }
                            string hora = DateTime.Now.ToString("HH:mm:ss", System.Globalization.DateTimeFormatInfo.InvariantInfo);                            
                            try
                            {
                                connection.Open();
                            }
                            catch { }                                  
                            MySqlCommand selectt = connection.CreateCommand();
                            selectt.CommandText = "SELECT horarios.generos FROM horarios WHERE horarios.dia = '" + sdia + "' AND horarios.tiempo_inicial <= '" + hora + "' AND horarios.tiempo_final > '" + hora + "'";
                            DataSet datasett = new DataSet();
                            MySqlDataAdapter dataa = new MySqlDataAdapter();
                            dataa.SelectCommand = selectt;
                            try
                            {
                                dataa.Fill(datasett, "generoact");
                            }
                            catch { }
                            MySqlCommand select2 = connection.CreateCommand();
                            DataSet dataset2 = new DataSet();
                            MySqlDataAdapter data2 = new MySqlDataAdapter();
                            if (datasett.Tables["generoact"].Rows.Count == 0)
                            {
                                select2.CommandText = "SELECT canciones.id, canciones.ruta, canciones.genero FROM canciones ORDER BY `canciones`.`cantidad_pedidas`";
                                generoactual = "Todos";
                                generoanterior = "Todos";
                            }
                            else
                            {
                                select2.CommandText = "SELECT canciones.id, canciones.ruta, canciones.genero FROM canciones WHERE FIND_IN_SET( canciones.genero, ( SELECT horarios.generos FROM horarios WHERE horarios.dia = '" + sdia + "' AND horarios.tiempo_inicial <= '" + hora + "' AND horarios.tiempo_final > '" + hora + "')) ORDER BY `canciones`.`cantidad_pedidas`";
                                generoactual = datasett.Tables["generoact"].Rows[0][0].ToString();
                                generoanterior = datasett.Tables["generoact"].Rows[0][0].ToString();
                            }
                            data2.SelectCommand = select2;
                            try
                            {
                                data2.Fill(dataset2, "Cgeneroact");
                            }
                            catch { }                            
                            MySqlCommand erase = connection.CreateCommand();
                            erase.CommandText = "TRUNCATE TABLE peticiones";
                            try
                            {
                                erase.ExecuteNonQuery();
                            }
                            catch { }
                            MySqlCommand erase2 = connection.CreateCommand();
                            erase2.CommandText = "TRUNCATE TABLE playlist_actual";
                            try
                            {
                                erase2.ExecuteNonQuery();
                            }
                            catch { }
                            MySqlCommand cant_ped = connection.CreateCommand();
                            cant_ped.CommandText = "UPDATE canciones SET cantidad_pedidas=cantidad_pedidas+1 WHERE id=" + dataset2.Tables["Cgeneroact"].Rows[0]["id"];
                            try
                            {
                                cant_ped.ExecuteNonQuery();
                            }
                            catch { }
                            connection.Close();
                            if (System.IO.File.Exists(TPlaylistPath) == true)
                                System.IO.File.Delete(TPlaylistPath);
                            FileStream TPlaylist = new FileStream(TPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite | FileShare.Delete);
                            StreamWriter newline = new StreamWriter(TPlaylist, Encoding.Default);
                            newline.WriteLine("#EXTM3U");
                            newline.WriteLine("#EXTINF:");
                            newline.WriteLine(dataset2.Tables["Cgeneroact"].Rows[0]["ruta"].ToString());
                            newline.Flush();
                            newline.Close();
                            newline.Dispose();
                            TPlaylist.Close();
                            TPlaylist.Dispose();                            
                        }
                        else
                        {                              
                            SendMessage(hwndWinamp, WM_USER, 0, 120);
                            EliminarTrackActual(titulo);
                            agregarpeticiones();
                        }
                        ProcessStartInfo DirTmpPlaylist = new ProcessStartInfo(TPlaylistPath);
                        Process RunTmpPlaylist = Process.Start(DirTmpPlaylist);
                        Thread.Sleep(1000);
                        SendMessage(hwndWinamp, WM_USER, 0, 120);
                        actualizarplaylist();                        
                        timer1.Enabled = true;                        
                    }                    
                }                
            }
            else 
            {
                ProcessStartInfo Winampdir = new ProcessStartInfo(WinampPath);
                Process RunWinamp = Process.Start(Winampdir);
                Thread.Sleep(3000);
                hwndWinamp = FindWindow("Winamp v1.x", null);
                SendMessage(hwndWinamp, WM_USER, 0, 101);
                SendMessage(hwndWinamp, WM_USER, 0, 120);                
                try
                {
                    connection.Open();
                }
                catch { }  
                MySqlCommand select = connection.CreateCommand();
                select.CommandText = "SELECT canciones.ruta FROM playlist_actual,canciones WHERE playlist_actual.cancion_idfk=canciones.id ORDER BY playlist_actual.orden";
                DataSet dataset = new DataSet();
                data.SelectCommand = select;
                data.Fill(dataset, "playlist_actual");
                connection.Close();
                FileStream WPlaylist = new FileStream(WPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite);
                StreamWriter newline = new StreamWriter(WPlaylist, Encoding.Default);            
                for (int x = 0; x < dataset.Tables["playlist_actual"].Rows.Count; x++)
                {
                    newline.WriteLine("#EXTINF:");
                    newline.WriteLine(dataset.Tables["playlist_actual"].Rows[x]["ruta"].ToString());
                    newline.Flush();
                }
                newline.Close();
                newline.Dispose();
                WPlaylist.Close();
                WPlaylist.Dispose();
                ProcessStartInfo DirWnmpPlaylist = new ProcessStartInfo(WPlaylistPath);
                Process RunWnmpPlaylist = Process.Start(DirWnmpPlaylist);
                Thread.Sleep(1000);
                SendMessage(hwndWinamp, WM_USER, 0, 120);
            }                          
     
        }
        

        public void EliminarTrackActual(string[] titulo)
        {
            System.IO.File.Delete(TPlaylistPath);
            FileStream WPlaylist = new FileStream(WPlaylistPath, FileMode.Open, FileAccess.Read, FileShare.ReadWrite);
            StreamReader line = new StreamReader(WPlaylist, Encoding.Default);            
            FileStream TPlaylist = new FileStream(TPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite | FileShare.Delete);
            StreamWriter newline = new StreamWriter(TPlaylist, Encoding.Default);
            int g = 0;
            string readedline = "";
            while ((readedline = line.ReadLine()) != null)
            {
                if (g != 1 && g != 2)
                {
                    newline.WriteLine(readedline);
                    newline.Flush();
                }
                g++;
            }                        
            line.Close();
            line.Dispose();
            newline.Close();
            newline.Dispose();
            WPlaylist.Close();
            WPlaylist.Dispose();
            TPlaylist.Close();           
            TPlaylist.Dispose();
            try
            {
                connection.Open();
            }
            catch { }                  
            MySqlCommand fecha_tocada = connection.CreateCommand();
            DateTime actual = DateTime.Now;
            string sactual = actual.ToString("yyyyMMddHHmmss");
            fecha_tocada.CommandText = "UPDATE canciones SET ultima_tocada='" + sactual + "' WHERE titulo='" + titulo[1] + "' AND artista='" + titulo[0] + "'";
            try
            {
                fecha_tocada.ExecuteNonQuery();
            }
            catch {}
            connection.Close();            
        }

        public string GetSongTitle()
        {
            hwndWinamp = FindWindow("Winamp v1.x", null);
            string lpText = new string((char)0, 100);
            int intLength = GetWindowText(hwndWinamp, lpText, lpText.Length);
            string strTitle = lpText.Substring(0, intLength);
            int intName = strTitle.IndexOf(strTtlEnd);
            int intLeft = strTitle.IndexOf("[");
            int intRight = strTitle.IndexOf("]");
            if ((intName >= 0) && (intLeft >= 0) && (intName < intLeft) && (intRight >= 0) && (intLeft + 1 < intRight))
                return strTitle.Substring(intLeft + 1, intRight - intLeft - 1);
            if ((strTitle.EndsWith(strTtlEnd)) && (strTitle.Length > strTtlEnd.Length))
                strTitle = strTitle.Substring(0,strTitle.Length - strTtlEnd.Length);
            int intDot = strTitle.IndexOf(".");
            if ((intDot > 0) && IsNumeric(strTitle.Substring(0, intDot)))
                strTitle = strTitle.Remove(0, intDot + 1);
            return strTitle.Trim();
        }

        public bool IsNumeric(string Value)
        {
            try
            {
                double.Parse(Value);
                return true;
            }
            catch
            {
                return false;
            }
        }

        public void agregarpeticiones()
        {        
            try
            {
                connection.Open();
            }
            catch { }                  
            MySqlCommand select = connection.CreateCommand();
            select.CommandText = "SELECT peticiones.id,canciones.ruta FROM peticiones,canciones WHERE peticiones.cancion_idfk=canciones.id ORDER BY peticiones.fecha_pedida";
            DataSet dataset = new DataSet();
            data.SelectCommand = select;
            data.Fill(dataset, "peticiones");
            MySqlCommand select3 = connection.CreateCommand();
            select3.CommandText = "SELECT * FROM playlist_actual";
            DataSet dataset3 = new DataSet();
            data.SelectCommand = select3;
            data.Fill(dataset3, "playlist");
            if (dataset.Tables["peticiones"].Rows.Count == 0)
            {
                if (dataset3.Tables["playlist"].Rows.Count <= 10)
                {
                    DateTime dia = DateTime.Now;
                    string sdia = dia.DayOfWeek.ToString();
                    switch (sdia)
                    {
                        case "Monday":
                            sdia = "lunes";
                            break;
                        case "Tuesday":
                            sdia = "martes";
                            break;
                        case "Wednesday":
                            sdia = "miercoles";
                            break;
                        case "Thursday":
                            sdia = "jueves";
                            break;
                        case "Friday":
                            sdia = "viernes";
                            break;
                        case "Saturday":
                            sdia = "sabado";
                            break;
                        case "Sunday":
                            sdia = "domingo";
                            break;
                    }
                    string hora = DateTime.Now.ToString("HH:mm:ss", System.Globalization.DateTimeFormatInfo.InvariantInfo);
                    MySqlCommand selectt = connection.CreateCommand();
                    selectt.CommandText = "SELECT horarios.generos FROM horarios WHERE horarios.dia = '" + sdia + "' AND horarios.tiempo_inicial <= '" + hora + "' AND horarios.tiempo_final > '" + hora + "'";
                    DataSet datasett = new DataSet();
                    MySqlDataAdapter dataa = new MySqlDataAdapter();
                    dataa.SelectCommand = selectt;
                    try
                    {
                        dataa.Fill(datasett, "generoact");
                    }
                    catch { }
                    MySqlCommand select2 = connection.CreateCommand();
                    DataSet dataset2 = new DataSet();
                    MySqlDataAdapter data2 = new MySqlDataAdapter();
                    if (datasett.Tables["generoact"].Rows.Count == 0)
                    {
                        select2.CommandText = "SELECT canciones.id, canciones.ruta, canciones.genero FROM canciones ORDER BY `canciones`.`cantidad_pedidas`";
                        generoanterior = "Todos";
                    }
                    else
                    {                        
                        select2.CommandText = "SELECT canciones.id, canciones.ruta, canciones.genero FROM canciones WHERE FIND_IN_SET( canciones.genero, ( SELECT horarios.generos FROM horarios WHERE horarios.dia = '" + sdia + "' AND horarios.tiempo_inicial <= '" + hora + "' AND horarios.tiempo_final > '" + hora + "')) ORDER BY `canciones`.`cantidad_pedidas`";
                        generoanterior = datasett.Tables["generoact"].Rows[0][0].ToString();
                    }
                    data2.SelectCommand = select2;
                    try
                    {
                        data2.Fill(dataset2, "Cgeneroact");
                    }
                    catch { }
                    FileStream WPlaylistr = new FileStream(TPlaylistPath, FileMode.Open, FileAccess.Read, FileShare.ReadWrite);
                    StreamReader line = new StreamReader(WPlaylistr, Encoding.Default);
                    int g = 0;                    
                    bool added = false, exist = false;
                    string readedline = "";
                    for (int z = 0; z < dataset2.Tables["Cgeneroact"].Rows.Count; z++)
                    {                        
                        while ((readedline = line.ReadLine()) != null)
                        {                            
                            if ((g != 0) && ((g % 2) == 0) && readedline != dataset2.Tables["Cgeneroact"].Rows[z]["ruta"].ToString())
                            {
                                line.Close();
                                line.Dispose();
                                WPlaylistr.Close();
                                WPlaylistr.Dispose();
                                FileStream WPlaylistw = new FileStream(TPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite);
                                StreamWriter newline = new StreamWriter(WPlaylistw, Encoding.Default);
                                newline.WriteLine("#EXTINF:");
                                newline.WriteLine(dataset2.Tables["Cgeneroact"].Rows[z]["ruta"].ToString());
                                newline.Flush();
                                added = true;
                                newline.Close();
                                newline.Dispose();
                                WPlaylistw.Close();
                                WPlaylistw.Dispose();
                                MySqlCommand cant_ped = connection.CreateCommand();
                                cant_ped.CommandText = "UPDATE canciones SET cantidad_pedidas=cantidad_pedidas+1 WHERE id=" + dataset2.Tables["Cgeneroact"].Rows[z]["id"];
                                try
                                {
                                    cant_ped.ExecuteNonQuery();
                                }
                                catch { }
                                break;
                            }                            
                            else if (readedline == dataset2.Tables["Cgeneroact"].Rows[z]["ruta"].ToString())
                            {
                                exist = true;
                                break;
                            }
                            g++;

                        }
                        if (g == 1)
                        {
                            line.Close();
                            line.Dispose();
                            WPlaylistr.Close();
                            WPlaylistr.Dispose();
                            FileStream WPlaylistw = new FileStream(TPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite);
                            StreamWriter newline = new StreamWriter(WPlaylistw, Encoding.Default);
                            newline.WriteLine("#EXTINF:");
                            newline.WriteLine(dataset2.Tables["Cgeneroact"].Rows[z]["ruta"].ToString());
                            newline.Flush();
                            added = true;
                            newline.Close();
                            newline.Dispose();
                            WPlaylistw.Close();
                            WPlaylistw.Dispose();
                            MySqlCommand cant_ped = connection.CreateCommand();
                            cant_ped.CommandText = "UPDATE canciones SET cantidad_pedidas=cantidad_pedidas+1 WHERE id=" + dataset2.Tables["Cgeneroact"].Rows[z]["id"];
                            try
                            {
                                cant_ped.ExecuteNonQuery();
                            }
                            catch { }
                            break;
                        }
                        if (added == true)
                        {
                            break;
                        }
                        if (exist == true)
                            continue;                        
                    } 
                }                                               
            }
            else 
            {
                FileStream WPlaylist = new FileStream(TPlaylistPath, FileMode.Append, FileAccess.Write, FileShare.ReadWrite);
                StreamWriter line = new StreamWriter(WPlaylist, Encoding.Default);
                for (int y = 0; y < dataset.Tables["peticiones"].Rows.Count; y++)
                {
                    line.WriteLine("#EXTINF:");
                    line.WriteLine(dataset.Tables["peticiones"].Rows[y]["ruta"].ToString());
                    line.Flush();
                    MySqlCommand erase = connection.CreateCommand();
                    erase.CommandText = "DELETE FROM peticiones WHERE peticiones.id=" + dataset.Tables["peticiones"].Rows[y]["id"];                    
                    try
                    {
                        erase.ExecuteNonQuery();
                    }
                    catch {}
                }
                line.Close();
                line.Dispose();
                WPlaylist.Close();                
                WPlaylist.Dispose();                
            }
            connection.Close();            
        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {
            try
            {
                connection.Open();
                MySqlCommand erase = connection.CreateCommand();
                erase.CommandText = "TRUNCATE TABLE peticiones";
                try
                {
                    erase.ExecuteNonQuery();
                }
                catch { }
                MySqlCommand erase2 = connection.CreateCommand();
                erase2.CommandText = "TRUNCATE TABLE playlist_actual";
                try
                {
                    erase2.ExecuteNonQuery();
                }
                catch { }
                MySqlCommand app_running = connection.CreateCommand();
                app_running.CommandText = "UPDATE configuracion_sitio SET valor='true'  WHERE llave='de_vacas'";
                try
                {
                    app_running.ExecuteNonQuery();
                }
                catch { }
                connection.Close();
            }
            catch { }                

            if (connection.State == System.Data.ConnectionState.Open)
            {
                connection.Close();
            }            
            foreach (Process my_proceso in Process.GetProcesses())
            {
                if (my_proceso.ProcessName == "winamp")
                {
                    my_proceso.Kill();
                }
            }
        }

        public void actualizarplaylist()
        {
            Thread.Sleep(1000);            
            try
            {
                connection.Open();
            }
            catch { }                             
            MySqlCommand erase = connection.CreateCommand();
            erase.CommandText = "TRUNCATE TABLE playlist_actual";
            try
            {
                erase.ExecuteNonQuery();
            }
            catch { }
            MySqlDataAdapter data3 = new MySqlDataAdapter();
            MySqlCommand select3 = connection.CreateCommand();
            select3.CommandText = "SELECT * FROM playlist_actual";
            DataSet dataset3 = new DataSet();
            data3.SelectCommand = select3;
            data3.Fill(dataset3, "playlist");            
            int rows = dataset3.Tables["playlist"].Rows.Count;
            FileStream WPlaylist = new FileStream(WPlaylistPath, FileMode.Open, FileAccess.Read, FileShare.ReadWrite);
            StreamReader line = new StreamReader(WPlaylist, Encoding.Default);            
            int g = 0,orden=0;
            string readedline = "";
            while ((readedline = line.ReadLine()) != null)
            {
                if ((g != 0) && ((g % 2) == 0))
                {
                    orden++;
                    MySqlDataAdapter data4 = new MySqlDataAdapter();
                    MySqlCommand select4 = connection.CreateCommand();
                    select4.CommandText = "SELECT id,ruta FROM canciones";
                    DataSet dataset4 = new DataSet();
                    data4.SelectCommand = select4;
                    data4.Fill(dataset4, "canciones");                    
                    for (int f = 0; f < dataset4.Tables["canciones"].Rows.Count; f++)
                    {
                        if (readedline == dataset4.Tables["canciones"].Rows[f]["ruta"].ToString())
                        {
                            DataRow newrow = dataset3.Tables["playlist"].NewRow();
                            newrow["cancion_idfk"] = dataset4.Tables["canciones"].Rows[f]["id"];
                            newrow["orden"] = orden;
                            dataset3.Tables["playlist"].Rows.Add(newrow);
                            MySqlCommandBuilder mbuild2 = new MySqlCommandBuilder(data3);
                            try
                            {
                                data3.Update(dataset3, "playlist");

                            }
                            catch { }
                            break;
                        }                        
                    }                    
                }
                g++;
            }
            line.Close();
            WPlaylist.Close();
            line.Dispose();
            WPlaylist.Dispose();
            connection.Close();
        }
    }
}
