using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.IO;
using TagLib;
using MySql;
using MySql.Data;
using MySql.Data.MySqlClient;


namespace Control_de_Winamp
{
    public partial class Form2 : Form
    {
        //class MusicID3Tag
        //{
        //    public byte[] TAGID = new byte[3];      //  3     
        //    public byte[] Title = new byte[30];     //  30     
        //    public byte[] Artist = new byte[30];    //  30      
        //    public byte[] Album = new byte[30];     //  30      
        //    public byte[] Year = new byte[4];       //  4      
        //    public byte[] Comment = new byte[30];   //  30      
        //    public byte[] Genre = new byte[1];      //  1  
        //} 

        public Form2()
        {
            InitializeComponent();
        }        

        private void button1_Click(object sender, EventArgs e)
        {
            DialogResult result = folderBrowserDialog1.ShowDialog();
            if (result == DialogResult.OK)
            {
                //
                // The user selected a folder and pressed the OK button.
                // We print the number of files found.
                //
                textBox1.Text = "";
                textBox1.Text = folderBrowserDialog1.SelectedPath.ToString();
                textBox1.Select(textBox1.Text.Length, 0);
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            string[] files = Directory.GetFiles(textBox1.Text,"*.mp3",SearchOption.AllDirectories);
            for (int x = 0; x < files.Length; x++)
            {
                TagLib.File file = TagLib.File.Create(files[x]);
                string artista = file.Tag.FirstPerformer;
                string titulo = file.Tag.Title;
                string album = file.Tag.Album;
                string genero = file.Tag.FirstGenre;
                double duracion = file.Properties.Duration.TotalSeconds;
                string ruta = files[x];               
                MessageBox.Show(artista+" "+titulo+" "+album+" "+genero+" "+duracion);

                //using (FileStream fs = System.IO.File.OpenRead(files[x]))
                //{
                    

                    //if (fs.Length >= 128)
                    //{
                    //    MusicID3Tag tag = new MusicID3Tag();
                    //    fs.Seek(-128, SeekOrigin.End);
                    //    fs.Read(tag.TAGID, 0, tag.TAGID.Length);
                    //    fs.Read(tag.Title, 0, tag.Title.Length);
                    //    fs.Read(tag.Artist, 0, tag.Artist.Length);
                    //    fs.Read(tag.Album, 0, tag.Album.Length);
                    //    fs.Read(tag.Year, 0, tag.Year.Length);
                    //    fs.Read(tag.Comment, 0, tag.Comment.Length);
                    //    fs.Read(tag.Genre, 0, tag.Genre.Length);
                    //    string theTAGID = Encoding.Default.GetString(tag.TAGID);
                    //    if (theTAGID.Equals("TAG"))
                    //    {
                    //        string Title = Encoding.Default.GetString(tag.Title);
                    //        string Artist = Encoding.Default.GetString(tag.Artist);
                    //        string Album = Encoding.Default.GetString(tag.Album);
                    //        string Year = Encoding.Default.GetString(tag.Year);
                    //        string Comment = Encoding.Default.GetString(tag.Comment);
                    //        string Genre = Encoding.Default.GetString(tag.Genre);
                    //        MessageBox.Show(Title + " " + Artist + " " + Album + " " + Year + " " + Comment + " " + Genre);
                    //    }
                    //}
                //}                
            }
        }
    }
}
