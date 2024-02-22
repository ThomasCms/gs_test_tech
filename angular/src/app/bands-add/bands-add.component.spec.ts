import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BandsAddComponent } from './bands-add.component';

describe('BandsAddComponent', () => {
  let component: BandsAddComponent;
  let fixture: ComponentFixture<BandsAddComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [BandsAddComponent]
    });
    fixture = TestBed.createComponent(BandsAddComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
