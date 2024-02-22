import { Component } from '@angular/core';
import {Band} from "../models/band.model";
import {BandService} from "../services/band.service";

@Component({
  selector: 'app-bands-list',
  templateUrl: './bands-list.component.html',
  styleUrls: ['./bands-list.component.scss']
})
export class BandsListComponent {
  bands?: Band[];

  constructor(private bandService: BandService) { }

  ngOnInit(): void {
    this.retrieveBands();
  }

  retrieveBands(): void {
    this.bandService.index()
      .subscribe({
        next: (data) => {
          this.bands = data;
        },
        error: (e) => console.error(e)
      });
  }

  deleteBand(id: number|undefined): void {
    this.bandService.delete(id).subscribe({
      next: () => {
        location.reload();
      },
      error: (e) => console.error(e)
    });
  }
}
