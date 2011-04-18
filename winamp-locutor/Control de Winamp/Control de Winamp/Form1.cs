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




namespace Control_de_Winamp
{
    public partial class Form1 : Form
    {
        public const int WM_USER = 0x400;
        public const int WM_COMMAND = 0x0111;
        [DllImport("user32.dll")]
        public static extern IntPtr FindWindow(string lpClassName, string lpWindowName);
        [DllImport("user32.dll", CharSet=CharSet.Auto)]
        private static extern IntPtr SendMessageA(IntPtr hWnd, int msg, int wParam, int lParam);
        [DllImport("User32.Dll")]
        public static extern void GetWindowText(int h, StringBuilder s, int nMaxCount);
        IntPtr hwndWinamp;
        public Form1()
        {
            InitializeComponent();
            hwndWinamp = FindWindow("Winamp v1.x",null);
        }
        private void Form1_Load(object sender, EventArgs e)
        {
            MySqlConnection connection = new MySqlConnection("Server=184.154.79.138;Database=tonylar1_radioiit;Uid=tonylar1_iitbd;Pwd=password890;");
            connection.Open();
            //if (connection.State==ConnectionState.Open)
            //    MessageBox.Show("yeaahhh");
            this.WindowState = FormWindowState.Minimized;
            this.ShowInTaskbar = false;
            if (hwndWinamp==IntPtr.Zero)
            {
                //dir appdata %APPDATA%\Winamp\
                ProcessStartInfo dir = new ProcessStartInfo(@"C:\Program Files\Winamp\Winamp.exe");
                Process wnmpPlaylist = Process.Start(dir);
                Thread.Sleep(3000);
                hwndWinamp = FindWindow("Winamp v1.x",null);                
            }

        }

        private void actualizarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            //string[] filePaths = Directory.GetFiles(@"", "*.mp3", SearchOption.AllDirectories);
            Form2 actualizarDlg = new Form2();
            actualizarDlg.Show();           
        }

        private void salirToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Close();
        }    
    }
}
