import type { NextRequest } from "next/server";
import { NextResponse } from "next/server";
import nodemailer from "nodemailer";

const ownerEmail = process.env.CONTACT_OWNER_EMAIL;
const fromEmail = process.env.CONTACT_FROM_EMAIL ?? process.env.CONTACT_OWNER_EMAIL;

export async function POST(req: NextRequest) {
  try {
    const body = await req.json();
    const { name, email, phone, needs } = body as {
      name?: string;
      email?: string;
      phone?: string;
      needs?: string;
    };

    if (!name || !email || !phone || !needs) {
      return NextResponse.json({ error: "Invalid payload" }, { status: 400 });
    }

    if (!ownerEmail || !fromEmail) {
      console.error("Missing CONTACT_OWNER_EMAIL or CONTACT_FROM_EMAIL env vars");
      return NextResponse.json({ error: "Email not configured" }, { status: 500 });
    }

    const transporter = nodemailer.createTransport({
      host: process.env.SMTP_HOST ?? "smtp.gmail.com",
      port: Number(process.env.SMTP_PORT ?? 587),
      secure: false,
      auth: {
        user: process.env.SMTP_USER,
        pass: process.env.SMTP_PASS,
      },
    });

    const siteUrl = process.env.NEXT_PUBLIC_SITE_URL ?? "";
    const logoUrl = process.env.EMAIL_LOGO_URL ?? (siteUrl ? `${siteUrl}/logo.png` : "");

    const now = new Date();

    const baseStyles = {
      wrapper: 'background-color:#000;color:#fff;font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;padding:32px;',
      card: "max-width:600px;margin:0 auto;border:1px solid #333;border-radius:12px;background-color:#050505;padding:28px;",
      logoRow: "text-align:center;margin-bottom:24px;",
      logoImg: "max-width:80px;height:auto;margin:0 auto;",
      title: "font-size:20px;font-weight:600;margin:0 0 12px 0;color:#fff;",
      muted: "font-size:13px;color:#a1a1aa;margin:0;",
      divider: "border-top:1px solid #27272a;margin:24px 0;",
      table: "width:100%;border-collapse:collapse;font-size:14px;",
      th: "text-align:left;padding:6px 0;color:#a1a1aa;width:140px;vertical-align:top;",
      td: "padding:6px 0;color:#e5e5e5;",
      footer: "margin-top:24px;font-size:11px;color:#71717a;text-align:center;",
    } as const;

    const ownerHtml = `
      <div style="${baseStyles.wrapper}">
        <div style="${baseStyles.card}">
          <div style="${baseStyles.logoRow}">
            ${logoUrl ? `<img src="${logoUrl}" alt="Logo" style="${baseStyles.logoImg}" />` : ""}
          </div>
          <h1 style="${baseStyles.title}">Kontak Baru dari Website</h1>
          <p style="${baseStyles.muted}">${now.toLocaleString()}</p>
          <div style="${baseStyles.divider}"></div>
          <table style="${baseStyles.table}">
            <tbody>
              <tr>
                <th style="${baseStyles.th}">Nama</th>
                <td style="${baseStyles.td}">${name}</td>
              </tr>
              <tr>
                <th style="${baseStyles.th}">Email</th>
                <td style="${baseStyles.td}">${email}</td>
              </tr>
              <tr>
                <th style="${baseStyles.th}">No HP</th>
                <td style="${baseStyles.td}">${phone}</td>
              </tr>
              <tr>
                <th style="${baseStyles.th}">Kebutuhan</th>
                <td style="${baseStyles.td}">${needs.replace(/\n/g, "<br/>")}</td>
              </tr>
            </tbody>
          </table>
          <p style="${baseStyles.footer}">
            Email ini dikirim otomatis dari form kontak website${siteUrl ? ` (${siteUrl})` : ""}.
          </p>
        </div>
      </div>
    `;

    const clientHtml = `
      <div style="${baseStyles.wrapper}">
        <div style="${baseStyles.card}">
          <div style="${baseStyles.logoRow}">
            ${logoUrl ? `<img src="${logoUrl}" alt="Logo" style="${baseStyles.logoImg}" />` : ""}
          </div>
          <h1 style="${baseStyles.title}">Terima kasih sudah menghubungi Nexteam</h1>
          <p style="${baseStyles.muted}">
            Halo ${name}, kami sudah menerima pesanmu dan akan segera menghubungi kembali.
          </p>
          <div style="${baseStyles.divider}"></div>
          <p style="${baseStyles.muted}">Ringkasan pesanmu:</p>
          <table style="${baseStyles.table}">
            <tbody>
              <tr>
                <th style="${baseStyles.th}">Nama</th>
                <td style="${baseStyles.td}">${name}</td>
              </tr>
              <tr>
                <th style="${baseStyles.th}">Email</th>
                <td style="${baseStyles.td}">${email}</td>
              </tr>
              <tr>
                <th style="${baseStyles.th}">No HP</th>
                <td style="${baseStyles.td}">${phone}</td>
              </tr>
              <tr>
                <th style="${baseStyles.th}">Kebutuhan</th>
                <td style="${baseStyles.td}">${needs.replace(/\n/g, "<br/>")}</td>
              </tr>
            </tbody>
          </table>
          <p style="${baseStyles.footer}">
            Jika kamu tidak merasa mengisi form ini, abaikan saja email ini.
          </p>
        </div>
      </div>
    `;

    // Send email to owner
    await transporter.sendMail({
      from: fromEmail,
      to: ownerEmail,
      subject: `Kontak Baru dari ${name}`,
      replyTo: email,
      html: ownerHtml,
    });

    // Auto-reply to client
    await transporter.sendMail({
      from: fromEmail,
      to: email,
      subject: "Terima kasih sudah menghubungi Nexteam",
      html: clientHtml,
    });

    return NextResponse.json({ success: true });
  } catch (err) {
    console.error("/api/contact error", err);
    return NextResponse.json({ error: "Internal server error" }, { status: 500 });
  }
}
