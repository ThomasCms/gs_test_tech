import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { BandsListComponent } from './bands-list/bands-list.component';
import { BandsAddComponent } from './bands-add/bands-add.component';
import { BandsUpdateComponent } from './bands-update/bands-update.component';

@NgModule({
  declarations: [
    AppComponent,
    BandsListComponent,
    BandsAddComponent,
    BandsUpdateComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
