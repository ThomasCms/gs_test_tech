import { Component } from '@angular/core';
import {Band} from "../models/band.model";
import { BandService } from '../services/band.service';

@Component({
  selector: 'app-bands-add',
  templateUrl: './bands-add-component.html',
  styleUrls: ['./bands-add.component.scss']
})
export class BandsAddComponent {
  band: Band = {
    name: '',
    country: '',
    city: '',
    details: '',
    musicStyle: '',
  };

  constructor(private bandService: BandService) { }

  saveBand(): void {
    this.bandService.create(this.band)
      .subscribe({
        next: () => {
          location.reload();
        },
        error: (e) => console.error(e)
      });
  }
}
