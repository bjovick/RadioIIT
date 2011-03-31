#include <windows.h>
#include <shellapi.h>
#include "resource.h"
#include <iostream>
#include <string>



NOTIFYICONDATA Tray;
HWND hWnd;
HINSTANCE hInstance;


int main(int argc, char* argv[])

{
    hWnd=FindWindow(L"ConsoleWindowClass",NULL);
	//hide the window
	//ShowWindow(hWnd,0);
	//tray info
	hInstance=GetModuleHandle(NULL);
	Tray.cbSize=sizeof(Tray);
	Tray.hIcon=LoadIcon(hInstance, MAKEINTRESOURCE(IDI_ICON1));
	Tray.hWnd=hWnd;
	wcscpy_s(Tray.szTip,L"RadioIIT Service");
	Tray.uCallbackMessage=WM_LBUTTONDOWN;
	Tray.uFlags=NIF_ICON | NIF_TIP | NIF_MESSAGE;
	Tray.uID=1;
	//set the icon in tasbar tray
	Shell_NotifyIcon(NIM_ADD, &Tray);


	HWND hwndWinamp = FindWindow(L"Winamp v1.x",NULL); //Finding window
    SendMessage(hwndWinamp,WM_COMMAND, 40046, 1); // Pause/play
    Sleep(1000);
    SendMessage(hwndWinamp,WM_COMMAND, 40046, 1); // Pause/play
    Sleep(1000);
    SendMessage(hwndWinamp,WM_COMMAND, 40148, 1); // 5 seconds forward

    //------------------------------------------------
    //THIS IS HOW TO GET THE TITLE OF THE CURRENT SONG
    char this_title[2048],*p;
    GetWindowTextA(hwndWinamp,this_title,sizeof(this_title));
    p = this_title+strlen(this_title)-8;
    while (p >= this_title)
    {
        if (!strnicmp(p,"- Winamp",8)) break;
        p--;
    }
    if (p >= this_title) p--;
    while (p >= this_title && *p == ' ') p--;
    *++p=0;
    ////THIS IS HOW TO GET THE TITLE OF THE CURRENT SONG
    ////------------------------------------------------

    std::cout << this_title; // Prints the current title
    Sleep(3000);

	Shell_NotifyIcon(NIM_DELETE, &Tray);

    return 0;
}

