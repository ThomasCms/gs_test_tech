import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {BandsListComponent} from "./bands-list/bands-list.component";
import {BandsUpdateComponent} from "./bands-update/bands-update.component";

const routes: Routes = [
  { path: '', redirectTo: 'bands', pathMatch: 'full' },
  { path: 'bands', title: 'Les groupes', component: BandsListComponent },
  { path: 'bands/update/:id', component: BandsUpdateComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
