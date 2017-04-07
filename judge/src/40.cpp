#include <iostream>
using namespace std;
int main(){
    double a[1000],sum,num;;
    int t,n,i;
    cin>>t;
    for(;t>0;t--){
        cin>>n;
        sum=0;num=0;
        for(i=0;i<n;i++){
            cin>>a[i];
            sum+=a[i];
        }
        sum/=n;
        for(i=0;i<n;i++)
            if(a[i]>sum)++num;    
        printf("%.3lf\%%\n",100.0*num/n);
    }
    return 0;
}        
