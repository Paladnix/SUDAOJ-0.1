#include <iostream>
using namespace std;
char s[3][4];
int num(char c){
    int i,j;
    int sum=0;
    for(i=0;i<3;i++)
        for(j=0;j<3;j++)
            if(s[i][j]==c)++sum;
    return sum;
}    
int line(char c){
    int i;
    for(i=0;i<3;i++){
        if(s[i][0]==s[i][1] && s[i][0]==s[i][2] && s[i][0]==c)return 1;
        if(s[0][i]==s[1][i] && s[0][i]==s[2][i] && s[0][i]==c)return 1;
    }
    if(s[0][0]==s[1][1] && s[0][0]==s[2][2] && s[0][0]==c)return 1;
    if(s[0][2]==s[1][1] && s[2][0]==s[1][1] && s[1][1]==c)return 1;
    return 0;
}        
        
int main(){
    int a,b;
    int n;
    cin>>n;
    for(;n>0;n--){
        getchar();
        gets(s[0]);
        gets(s[1]);
        gets(s[2]);
        a=num('X');b=num('O');
        if(a<b) {
            cout<<"no"<<endl;
            continue;
        }    
        if(a-b>1){
            cout<<"no"<<endl;
            continue;
        }
        if(a-b==1){
            if(line('O')){
                cout<<"no"<<endl;
                continue;
            }
        }  
        if(a==b){  
            if(line('X')){
                cout<<"no"<<endl;
                continue;
            }  
        }      
        cout<<"yes"<<endl;
    }
    return 1;
}        
 
        
